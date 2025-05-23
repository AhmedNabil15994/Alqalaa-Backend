<?php

namespace Modules\Indebtednes\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Core\Traits\DataTable;
use Modules\Indebtednes\Http\Requests\Dashboard\PayIndebtednesRequest;
use Modules\Indebtednes\Transformers\Dashboard\IndebtednesExportResource;

class IndebtednesController extends Controller
{
    use CrudDashboardController{
        __construct as __crudConstruct;
    }

    public function __construct()
    {
        $this->__crudConstruct();
        $this->setViewPath('indebtednes::dashboard.indebtednes');
    }

    public function datatable(Request $request)
    {
        return $this->datatableExport($request);
    }

    public function datatableExport(Request $request)
    {
        $query = $this->query($request);
        $total = $query;
        $total = $this->buildTotals($total);
        $datatable = $this->drawTable($request, $query);

        $datatable['data'] = IndebtednesExportResource::collection($datatable['data'])->add($total);

        return Response()->json($datatable);
    }

    
    private function handlingExportRequest($request)
    {
        $data = json_decode($request->data);
        $req = $data->req;
        $request->merge(['req' => (array)$req,'get_all' => true]);
        return $request;
    }

    public function exportTransaction($request, $type, $transaction)
    {
        $this->currentExportTransaction = $transaction;
        switch ($type) {
            case 'pdf':
            case 'print':
                $data = $this->datatableExport($request);
                return $this->repository->createPDF($data->getData()->data, $type, $transaction);
            case 'excel':
                return $this->repository->exportExcel($this->repository->QueryTable($request) , IndebtednesExportResource::class, $transaction);
        }
        return 'field';
    }

    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }

    public function edit($id)
    {
        $model = $this->repository->findValidToEditById($id);

        return $this->view('edit', compact('model'));
    }

    public function printIndebtednes($id)
    {
        $model = $this->repository->findById($id);

        return $this->view('components.print',compact('model'));
    }

    public function buildTotals($query)
    {
        $total_price = $query;
        $remaining = $query;
        $paid_value = $query;
        $total_price = $total_price->sum('price');
        $remaining = $remaining->get()->sum('total_installment_remaining');
        $paid_value = $paid_value->get()->sum('total_paid');

        return [
            'id' => __('indebtednes::dashboard.indebtednes.datatable.total'),
            'indebt_number' => '----',
            'client_id' => '----',
            'phone' => '----',
            'price' => number_format($total_price,1),
            'remaining' => number_format($remaining,1),
            'paid' => number_format($paid_value,1),
            'details' => '----',
            'completed_at' => '----',
            'created_at' => '----',
            'options' => '----',
        ];
    }

    public function refreshTable($id){
        $model = $this->repository->findById($id);
        return response()->json(['table' => $this->view('components.instalment-table',compact('model'))->render()]);
    }

    public function pay(PayIndebtednesRequest $request , $id){

        try {

            $pay = $this->repository->pay($request , $id);

            if ($pay) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function cancel($indebtednes , $id){

        try {

            $cancel = $this->repository->cancel($indebtednes , $id);

            if ($cancel) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    protected function getWithClient($client)
    {
        $records = $this->repository->getWithClient($client);
        return response()->json($records);
    }

    // DataTable Methods
    public function drawTable($request, $query)
    {
        $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
        $sort['dir'] = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $counter = $query->count();

        $output['recordsTotal'] = $counter;
        $output['recordsFiltered'] = $counter;
        $output['draw'] = intval($request->input('draw'));

        // Get Data
        $models = $query->orderBy($sort['col'] ?? 'id', $sort['dir'] ?? 'desc');

        if(!$request->get_all){

            $models = $models
                ->skip($request->input('start'))
                ->take($request->input('length', 25));
        }

        if (isset($request['req']['client_id']) || $request->client_id) {
            $output['data'] = $models->get();
        }else{

            $output['data'] = $models
                ->groupBy('client_id')
                ->get();
        }

        return $output;
    }
}
