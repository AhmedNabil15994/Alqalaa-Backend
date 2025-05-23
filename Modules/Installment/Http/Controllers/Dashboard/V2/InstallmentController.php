<?php

namespace Modules\Installment\Http\Controllers\Dashboard\V2;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Installment\Repositories\Dashboard\V2\InstallmentRepository;
use Modules\Installment\Transformers\Dashboard\InstallmentExcelExportResource;
use Modules\Transaction\Services\CbkPaymentService;
use Modules\Core\Traits\DataTable;

class InstallmentController extends Controller
{
    protected $payment;

    use CrudDashboardController{
        __construct as __crudConstruct;
        createdResponse as CrudCreatedResponse;
        updatedResponse as CrudUpdatedResponse;
    }

    public function __construct()
    {
        $this->payment = new CbkPaymentService;
        $this->__crudConstruct();
        $this->setRepository(InstallmentRepository::class);
    }

    public function index(Request $request)
    {
        $routeName = $request->route()->getName();

        if($routeName == 'dashboard.installments.index'){

            $datatableRoute = 'dashboard.installments.datatable';
        }else{

            $datatableRoute = 'dashboard.installments.judging.datatable';
        }


        return $this->view('index' , compact('datatableRoute'));
    }

    private function handlingExportRequest($request)
    {
        $data = json_decode($request->data);
        $req = $data->req;
        $request->merge(['req' => (array) $req,'route_name' => $request->route()->getName()]);
        return $request;
    }

    public function datatable(Request $request)
    { 
        $query = $this->query($request);
        $total = $query;
        $datatable = $query;
        $datatable = DataTable::drawTable($request, $datatable);

        if(auth()->user()->can('show_installments_totals')){
            $total = $this->buildTotals($query);
            $resource = $this->model_resource;
            $datatable['data'] = $resource::collection($datatable['data'])->add($total);
        }else{

            $resource = $this->model_resource;
            $datatable['data'] = $resource::collection($datatable['data']);
        }

        return Response()->json($datatable);
    }

    private function getData(Request $request, $type = "data_table")
    {
        $user = $this->currentExportTransaction ? $this->currentExportTransaction->user : auth()->user();

        $query = $this->query($request);
        if ($type == 'data_table') {

            $datatable = DataTable::drawTable($request, $query);

        } elseif ($type == 'export') {

            $datatable = DataTable::drawPrintWithoutData($request, $query);

        }
        
        return $user->can('show_installments_totals') ? $this->buildWithTotals($datatable) : $datatable; 
    }

    public function exportTransaction($request, $type, $transaction)
    {
        $this->currentExportTransaction = $transaction;
        switch ($type) {
            case 'pdf':
            case 'print':
                $data = $this->getData($request, 'export');
                return $this->repository->createPDF($data, $type, $transaction);
            case 'excel':
                $resource = InstallmentExcelExportResource::class;
                return $this->repository->exportExcel($this->repository->QueryTable($request) , $resource , $transaction);
        }
        return 'field';
    }

    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }
    
    public function buildWithTotals($query)
    {
        $count_offer_percentage = $query->whereNotNull('offer_percentage')->count();
        $sum_offer_percentage = $query->whereNotNull('offer_percentage')->sum('offer_percentage');
        $offerPercentage = $count_offer_percentage > 0 ? number_format(($count_offer_percentage / $sum_offer_percentage),2) : 0.0;

        $query->push((object)[
            'id' => __('contract::dashboard.contracts.datatable.total'),
            'client_name' => '{"en":"----","ar":"----"}',
            'contract_number' => '----',
            'amount' => number_format($query->sum('amount'),2),
            'paid' => number_format($query->sum('paid'),2),
            'remaining' => number_format($query->sum('remaining'),2),
            'due_date' => '----',
            'transaction_date' => '----',
            'percentage' => "<span class=\"badge badge-primary\"> {$offerPercentage} %</span>",
            'status' => '----',
            'phone' => '----'
        ]);
        return $query;
    }
}
