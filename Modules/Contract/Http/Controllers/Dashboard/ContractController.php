<?php

namespace Modules\Contract\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Core\Traits\DataTable;
use Modules\Installment\Entities\Installment;

class ContractController extends Controller
{
    use CrudDashboardController{
        createdResponse as CrudCreatedResponse;
        updatedResponse as CrudUpdatedResponse;
        export as CrudExport;
    }

    public function reports()
    {
        return $this->view('reports');
    }

    public function refreshTable($id){
        $model = $this->repository->findById($id);
        return response()->json(['table' => $this->view('components.instalment-table',compact('model'))->render()]);
    }

    public function datatable(Request $request)
    {
        $query = $this->query($request);

        if(auth()->user()->can('show_contract_totals')){

            $total = $this->buildTotals($query);
        }

        $datatable = DataTable::drawTable($request, $query);

        $resource = $this->model_resource;


        if(auth()->user()->can('show_contract_totals')){

            $datatable['data'] = $resource::collection($datatable['data'])->add($total);
        }else{

            $datatable['data'] = $resource::collection($datatable['data']);
        }

        return Response()->json($datatable);
    }

    public function completedContractsIndex(){
        return $this->view('completed-index');
    }

    public function completedContractsDatatable(Request $request)
    {
        $request = $this->setStatus($request,'completed');
        return $this->dataTable($request);
    }

    public function currentContractsIndex(){
        return $this->view('current-index');
    }

    public function currentContractsDatatable(Request $request)
    {
        $request = $this->setStatus($request,'current');
        return $this->dataTable($request);
    }

    public function pendingContractsIndex(){
        return $this->view('pending-index');
    }

    public function pendingContractsDatatable(Request $request)
    {
        $request = $this->setStatus($request,'pending');
        return $this->dataTable($request);
    }

    private function handlingExportRequest($request)
    {
        return $request;
    }

    public function export(Request $request, $type,$status = null)
    {
        $data = json_decode($request->data);
        $req = $data->req;
        $request->merge(['req' => (array) $req]);

        if($status)
            $request = $this->setStatus($request,$status);

        return $this->CrudExport($request,$type);
    }

    private function getData(Request $request, $type = "data_table")
    {
        $query = $this->query($request);
        $total = $query;
        $datatable = $query;

        if ($type == 'data_table') {
            $datatable = DataTable::drawTable($request, $datatable);
            $user = auth()->user();
        } elseif ($type == 'export') {
            $datatable = DataTable::drawPrint($request, $datatable);
            $user = $this->currentExportTransaction->user;
        }

        if($user->can('show_contract_totals')){

            $total = $this->buildTotals($query);
            $resource = $this->model_resource;
            $datatable['data'] = $resource::collection($datatable['data'])->add($total);
        }else{

            $resource = $this->model_resource;
            $datatable['data'] = $resource::collection($datatable['data']);
        }

        return Response()->json($datatable);
    }

    public function setStatus(Request $request,$status)
    {

        if(is_array($request['req']))
            $request['req'] += ['complete_status' => $status];
        else
            $request['req'] = ['complete_status' => $status];

        return $request;
    }



    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }

    public function buildTotals($query)
    {
        $user = auth()->check() ? auth()->user() : $this->currentExportTransaction->user;
        $total_price = $query;
        $down_payment = $query;
        $remaining = $query;
        $installment_fees = $query;
        $installment_with_fees = $query;
        $installment_value = $query;
        $paid_value = $query;
        $profit = $query;
        $overdue_amounts = $query;
        $total_price = $total_price->sum('price');
        $down_payment = $down_payment->sum('down_payment');
        $remaining = $remaining->sum('remaining');
        $installment_with_fees = $installment_with_fees->sum('installment_with_fees');
        $installment_value = $installment_value->sum('installment_value');
        $paid_value = $paid_value->get()->sum('total_installment_paid');
        $profit = $profit->get()->sum('profit');
        $overdue_amounts = Installment::Late()->whereIn('contract_id',$overdue_amounts->pluck('id')->toArray())->sum('remaining');
        $installment_fees = $profit > 0 ?(($profit/$remaining) * 100) : 0;

        return [
            'id' => __('contract::dashboard.contracts.datatable.total'),
            'client_id' => '----',
            'contract_number' => '----',
            'price' => $user->can('show_contract_amount') ? number_format($total_price,1) : '----',
            'down_payment' => $user->can('show_contract_down_payment') ? number_format($down_payment,1) : '----',
            'remaining' => number_format($remaining,1),
            'installment_fees' => $user->can('show_installment_fees') ? number_format($installment_fees,1) : '----',
            'installment_with_fees' => number_format($installment_with_fees,1),
            'overdue_amounts' =>  number_format($overdue_amounts,3),
            'months_num' => '----',
            'created_user' => '----',
            'installment_value' => number_format($installment_value,1),
            'paid' => $user->can('show_contract_paid_amount') ? number_format($paid_value,1) : '----',
            'profit' => $user->can('show_contract_profit') ? number_format($profit,1) : '----',
            'completed_at' => '----',
            'created_at' => '----',
            'options' => '----',
        ];
    }

    public function edit($id)
    {
        $model = $this->repository->findValidToEditById($id);

        return $this->view('edit', compact('model'));
    }

    public function printContract($id)
    {
        $model = $this->repository->findById($id);

        if (!$model->is_pending_for_review) {
            return $this->view('components.print-contract',compact('model'));
        }else{
            abort(404);
        }
    }

    public function printIndebtednessCertificate($id) {
        $model = $this->repository->findById($id);

        if (!$model->is_pending_for_review) {
            return $this->view('components.print-indebtedness-certificate',compact('model'));
        }else{
            abort(404);
        }
    }
    protected function createdResponse($model, $data)
    {

        if (auth()->user()->can('can_update_contract_status') && !$model->is_pending_for_review) {
            $data['print_url'] = url(route('dashboard.contracts.print' , $model->id));
            $data['blank'] = true;
        }
        return $this->CrudCreatedResponse($model , $data);
    }

    protected function updatedResponse($model, $data)
    {

        if (auth()->user()->can('can_update_contract_status') && !$model->is_pending_for_review) {
            $data['print_url'] = url(route('dashboard.contracts.print' , $model->id));
            $data['blank'] = true;
        }
        return $this->CrudUpdatedResponse($model , $data);
    }

    protected function getWithClient($client)
    {
        $records = $this->repository->getWithClient($client);
        return response()->json($records);
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    // }
}
