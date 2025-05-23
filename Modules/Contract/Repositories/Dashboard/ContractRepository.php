<?php

namespace Modules\Contract\Repositories\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Contract\Entities\Contract;
use Modules\Contract\Entities\ContractStatus;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Installment\Repositories\Dashboard\InstallmentRepository;
use Modules\User\Repositories\Dashboard\ClientRepository;

class ContractRepository extends CrudRepository
{
    protected $monthRepo;
    protected $installmentRepo;
    protected $clientRepo;

    public function __construct()
    {
        parent::__construct(Contract::class);
        $this->statusAttribute = [];
        $this->monthRepo = new MonthPercentageRepository;
        $this->clientRepo = new ClientRepository();
    }

    public function getWithClient($client)
    {
        return $this->model->where('client_id', $client)->latest()->get();
    }


    public function findValidToEditById($id)
    {
        if (method_exists($this->model, 'trashed')) {
            $model = $this->model->ValidToEdit()->withDeleted()->findOrFail($id);
        } else {
            $model = $this->model->ValidToEdit()->findOrFail($id);
        }

        return $model;
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        if (auth()->user()->can('edit_contract_percentages')) {

            $presentage = $request->installment_fees;
            $month_number = $request->months_num;

        } else {

            $month = $this->monthRepo->findById($data['month_percentage_id']);
            $presentage = $month->presentage;
            $month_number = $month->month_number;
        }

        $status = $is_create ? ContractStatus::pending()->first() : false;

        if (auth()->user()->can('can_update_contract_status')) {

            if($request->contract_status_id)
                $status = ContractStatus::find($request->contract_status_id);
        }

        if($status != false)
            $data['status'] = optional($status)->contract_data;

        $data['remaining'] = $data['price'] - $data['down_payment'];
        $percentValue = $data['remaining'] * $presentage / 100;
        $data['installment_with_fees'] = $data['remaining'] + $percentValue;
        $data['installment_value'] = $data['installment_with_fees'] / $month_number;
        $data['installment_fees'] = $presentage;
        $data['transaction_date'] = Carbon::parse($data['transaction_date'])->toDateString();
        $data['months_num'] = $month_number;

        if ($is_create) {
            $latestContract = $this->model->withDeleted()->whereNotNull('contract_number')->orderBy('contract_number','desc')->first();
            $data['contract_number'] = $latestContract ? $latestContract->contract_number + 1 : 1;
        }

        if ($request->client_type && $request->client_type == 'create') {
            $client = $this->clientRepo->create($request);
            $data['client_id'] = $client->id;
        }

        return parent::prepareData($data, $request, $is_create);
    }

    protected function contractLines($model, $request)
    {
        //delete lines before adding
        $model->lines()->delete();

        if( isset($request->details) && is_array($request->details) )
        {
            for($i = 0; $i < count($request->details['contract_line_type_id']); $i++)
            {
                if(
                    isset($request->details['contract_line_type_id'][$i]) &&
                    // isset($request->details['description'][$i]) &&
                    // isset($request->details['notes'][$i]) &&
                    isset($request->details['name'][$i]) &&
                    isset($request->details['price'][$i])
                 )
                 {
                    $price_with_fees = 0;
                    if( $model->installment_fees > 0 )
                    {
                        $price_with_fees = $request->details['price'][$i] + ( ($request->details['price'][$i] * $model->installment_fees) / 100);
                    }

                    $data['contract_id'] = $model->id;
                    $data['contract_line_type_id'] = $request->details['contract_line_type_id'][$i];
                    $data['description'] = $request->details['description'][$i] ?? null;
                    $data['notes'] = $request->details['notes'][$i] ?? null;
                    $data['name'] = $request->details['name'][$i] ?? null;
                    $data['price'] = $request->details['price'][$i];
                    $data['price_with_fees'] = $price_with_fees;

                     $model->lines()->create($data);
                 }
            }
        }
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        $now = $model->transaction_date;

        for ($i = 1; $i <= $model->months_num; $i++) {

            $due_date = $i == 1 ? $now : $now->addMonth();

            $model->installments()->create(
                [
                    'amount' => $model->installment_value,
                    'remaining' => $model->installment_value,
                    'due_date' => $due_date
                ]
            );
        }

        $this->contractLines($model, $request);

        parent::modelCreated($model, $request, $is_created);
    }

    public function modelUpdated($model, $request): void
    {
        $model->installments()->delete();
        $now = $model->transaction_date;

        for ($i = 1; $i <= $model->months_num; $i++) {

            $due_date = $i == 1 ? $now : $now->addMonth();

            $model->installments()->create(
                [
                    'amount' => $model->installment_value,
                    'remaining' => $model->installment_value,
                    'due_date' => $due_date
                ]
            );
        }

        $this->contractLines($model, $request);

        parent::modelCreated($model, $request);
    }

    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if (isset($request['req']['client_id']) && $request['req']['client_id']) {
            $query->where('client_id', $request['req']['client_id']);
        }

        if (auth()->user()->can('filter_contract_with_created_employee') && isset($request['req']['paid_by']) && $request['req']['paid_by']) {

            $query->whereHas('creationEmployee', function ($q) use($request){
                $q->where('causer_id',$request['req']['paid_by']);
            });
        }

        if (isset($request['req']['complete_status'])) {
            $query->where(function ($q) use ($request) {

                switch ($request['req']['complete_status']) {
                    case'late':
                        $q->whereHas('installments', function ($q) {
                            $q->where('remaining', '>', 0)
                                ->whereDate('due_date', '<', Carbon::now()->toDateString());
                        });
                        break;
                    case'completed':
                        $q->whereNotNull('completed_at')->doesnthave('NotComplatedInstallments');
                        break;
                    case'current':
                        $q->where(function ($q) {
                            $q->whereNull('completed_at');
                            $q->where(function ($q) {
                                $q->whereDate('transaction_date','<=',Carbon::now()->toDateString())->CanPayInstallmentScope();
                                $q->orWhereHas('installments', function ($q) {
                                    $q->where('paid', '>', 0);
                                });
                            });
                        });
                        break;
                    case'pending':
                        $q->PendingForReview();
                        break;
                }
            });
        }

        return parent::appendFilter($query, $request);
    }

    public function QueryTable($request)
    {

        $query = $this->model->where(function ($query) use ($request) {
            $query->where('contract_number', 'like', '%' . $request->input('search.value') . '%');
            $this->appendSearch($query, $request);
            foreach ($this->getModelTranslatable() as $key) {
                $query->orWhere($key . '->' . locale(), 'like', '%' . $request->input('search.value') . '%');
            }
        });

        $query = $this->filterDataTable($query, $request);
        return $query;
    }

    /**
     * @return mixed
     */
    public function getQueryActionsCols($helperData = null)
    {
        $QueryActionsCols = [];
        $QueryActionsCols[__('contract::dashboard.contracts.datatable.created_by')] = 'created_user';
        $QueryActionsCols['#'] = 'contract_number';
        $QueryActionsCols[__('contract::dashboard.contracts.datatable.client')] = 'client_id';

        if($helperData->user->can('show_contract_amount'))
            $QueryActionsCols[__('contract::dashboard.contracts.datatable.price')] = 'price';

        if($helperData->user->can('show_contract_down_payment'))
            $QueryActionsCols[__('contract::dashboard.contracts.datatable.down_payment')] = 'down_payment';

        $QueryActionsCols[__('contract::dashboard.contracts.datatable.remaining')] = 'remaining';
        $QueryActionsCols[__('contract::dashboard.contracts.datatable.installment_with_fees')] = 'installment_with_fees';

        if($helperData->user->can('show_installment_fees'))
            $QueryActionsCols[__('contract::dashboard.contracts.datatable.installment_fees').' % '] = 'installment_fees';

        $QueryActionsCols[__('contract::dashboard.contracts.datatable.months_num')] = 'months_num';
        $QueryActionsCols[__('contract::dashboard.contracts.datatable.installment_value')] = 'installment_value';

        if($helperData->user->can('show_contract_paid_amount'))
            $QueryActionsCols[__('contract::dashboard.contracts.datatable.paid')] = 'paid';

        if($helperData->user->can('show_contract_profit'))
            $QueryActionsCols[__('contract::dashboard.contracts.datatable.profit')] = 'profit';

        $QueryActionsCols[__('contract::dashboard.contracts.datatable.completed_at')] = 'completed_at';
        $QueryActionsCols[__('contract::dashboard.contracts.datatable.created_at')] = 'created_at';

        $this->QueryActionsCols = $QueryActionsCols;
        return $this->QueryActionsCols;
    }
}
