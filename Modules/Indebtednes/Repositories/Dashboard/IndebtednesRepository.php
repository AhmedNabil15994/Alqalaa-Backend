<?php

namespace Modules\Indebtednes\Repositories\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Indebtednes\Entities\Indebtednes;
use Modules\User\Repositories\Dashboard\ClientRepository;

class IndebtednesRepository extends CrudRepository
{
    protected $clientRepo;

    public function __construct()
    {
        parent::__construct(Indebtednes::class);
        $this->clientRepo = new ClientRepository();
        $setQueryActionsCols = [
            '#' => 'indebt_number',
            __('indebtednes::dashboard.indebtednes.datatable.client') => 'client_id',
            __('indebtednes::dashboard.indebtednes.datatable.phone') => 'phone',
            __('indebtednes::dashboard.indebtednes.datatable.price') => 'price',
            __('indebtednes::dashboard.indebtednes.datatable.paid') => 'paid',
            __('indebtednes::dashboard.indebtednes.datatable.remaining') => 'remaining',
        ];
        if (request('client_id')) {
            $setQueryActionsCols += [
                __('indebtednes::dashboard.indebtednes.datatable.details') => 'details',
                __('indebtednes::dashboard.indebtednes.datatable.completed_at') => 'completed_at',
                __('indebtednes::dashboard.indebtednes.datatable.created_at') => 'created_at',
            ];
        }

        $this->setQueryActionsCols($setQueryActionsCols);

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
        $data['remaining'] = $request->price;

        if ($is_create) {
            $latestIndebt = $this->model->withDeleted()->whereNotNull('indebt_number')->orderBy('indebt_number','desc')->first();
            $data['indebt_number'] = $latestIndebt ? $latestIndebt->indebt_number + 1 : 1;
        }

        if ($request->client_type && $request->client_type == 'create') {
            $client = $this->clientRepo->create($request);
            $data['client_id'] = $client->id;
        }

        return parent::prepareData($data, $request, $is_create);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        $model->type = 'indebtednes';
        $model->save();
        parent::modelCreated($model, $request, $is_created);
    }

    public function pay($request, $id)
    {
        $model = $this->findById($id);

        DB::beginTransaction();

        try {

            if ($model->price == $model->total_paid) {
                return false;
            }

            $model->installments()->create(
                [
                    'amount' => $request->pay_now,
                    'remaining' => 0,
                    'paid' => $request->pay_now,
                    'due_date' => Carbon::now()->toDateString(),
                    'note' => $request->note,
                    'transaction_date' => $request->transaction_date,
                ]
            );

            $model->refresh();

            if ($model->price == $model->total_paid) {
                $model->update(['completed_at' => $request->transaction_date]);
            }

            DB::commit();
            return true;

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function cancel($indebtednes, $id)
    {
        $model = $this->findById($indebtednes);

        DB::beginTransaction();

        try {

            $model->installments()->where('id', $id)->delete();
            $model->refresh();

            if ($model->price > $model->total_paid) {
                $model->update(['completed_at' => null]);
            }

            DB::commit();
            return true;

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->client_id) {
            $query->where('client_id', $request->client_id);
        }
        return parent::appendFilter($query, $request);
    }

    public function appendSearch(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        $query->orWhere('note', 'like', '%'.$request->input('search.value').'%');
        $query->orWhereHas('client', function ($q) use ($request) {
            $q->where('name->'.locale(), 'like', '%'.$request->input('search.value').'%');
            $q->orWhereHas('phones', function ($q) use ($request) {
                $q->where('phone', 'like', '%'.$request->input('search.value').'%');
            });
        });

        return parent::appendSearch($query, $request);
    }
}
