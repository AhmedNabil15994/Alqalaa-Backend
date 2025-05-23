<?php

namespace Modules\Installment\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Installment\Transformers\Dashboard\InstallmentResource;
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
        $query = $this->query($request);
        $total = $query;
        $datatable = $query;

        if ($type == 'data_table') {
            $datatable = DataTable::drawTable($request, $datatable);
        } elseif ($type == 'export') {
            $datatable = DataTable::drawPrint($request, $datatable);
        }



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

    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }

    public function buildTotals($query)
    {
        $amount = $query;
        $remaining = $query;
        $paid = $query;
        $sum_offer_percentage = $query;
        $count_offer_percentage = $query;
        $amount = $amount->sum('amount');
        $remaining = $remaining->sum('remaining');
        $paid = $paid->sum('paid');
        $count_offer_percentage = $count_offer_percentage->whereNotNull('offer_percentage')->count();
        $sum_offer_percentage = $sum_offer_percentage->whereNotNull('offer_percentage')->sum('offer_percentage');
        $offerPercentage = $count_offer_percentage > 0 ? number_format(($count_offer_percentage / $sum_offer_percentage),2) : 0.0;

        return [
            'id' => __('contract::dashboard.contracts.datatable.total'),
            'contract_id' => '----',
            'contract_number' => '----',
            'client_name' => '----',
            'phone' => '----',
            'contract' => '----',
            'amount' => number_format($amount,2),
            'valid_to_pay' => '----',
            'remaining' => number_format($remaining,2),
            'paid' => number_format($paid,2),
            'due_date' => '----',
            'transaction_date' => '----',
            'offer_percentage' => "<span class=\"badge badge-primary\"> {$offerPercentage} %</span>",
            'note' => '----',
            'status' => '----',
            'status_check' => 'completed',
            'status_title' => '----',
            'payments' => '----',
            'created_at' => '----',
        ];
    }

    public  function cancel($id){
        try {

            $update = $this->repository->cancel($id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }

    }

    public  function updateDueDate(Request $request, $id){
        try {

            $update = $this->repository->updateDueDate($request, $id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }

    }

    public function multiPay(Request $request)
    {
        if(!count((array)$request->ides)){
            return $this->updateError([] , [false  , __('apps::dashboard.messages.failed')]);
        }

        try {
            $transaction = $this->repository->createPaymentUrl($request);

            if ($transaction[0]) {
                $payment = route('frontend.instalment.checkout', $transaction[1]->token);
                return response()->json([true,'payment' => $payment , 'transaction' => $transaction]);
            }

            return $this->updateError([] , [false  , $transaction[1] ?? __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return $this->updateError(null , [false, $e->errorInfo[2]]);
        }
    }

    public function multiSendWhatsapp(Request $request)
    {
        if(!count((array)$request->ids)){
            return $this->updateError([] , [false  , __('apps::dashboard.messages.failed')]);
        }

        try {
            $transaction = $this->repository->createPaymentsUrl($request);
            if ($transaction[0]) {
                return response()->json([true, __('apps::dashboard.messages.sent')]);
            }

            return $this->updateError([] , [false  , $transaction[1] ?? __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return $this->updateError(null , [false, $e->errorInfo[2]]);
        }
    }
    public function send_WAMsg(Request $request,$id)
    {
        $model = $this->repository->findById($id);
//        if($model->remaining > 0  && $model->due_date <= date('Y-m-d',strtotime('+2 days'))){
        if($model){
            $phone = '965'.$model->contract->client->phone->phone;
            $request =  new \Illuminate\Http\Request();
            $request->merge([
                'ides' => [$model->id],
                'user_id' => 1,
                'remaining' => [$model->remaining]
            ]);

            $transaction = $this->repository->createPaymentUrl($request,$model->id);
            if ($transaction[0]) {
                $url = route('frontend.instalment.checkout', $transaction[1]->token);
                $this->repository->sendMessage($url,$phone);
                return Response()->json([true , __('apps::dashboard.messages.sent')]);
            }
        }
        return $this->updateError([] , [false  , __('apps::dashboard.messages.failed')]);
    }

    public function multiEmployeePay(Request $request)
    {

        if(!auth()->user()->can('pay_installments')){
            abort(404);
        }

        if(!count((array)$request->ides)){
            return $this->updateError([] , [false  , __('apps::dashboard.messages.failed')]);
        }

        try {
            $transaction = $this->repository->payEmployeeInstalment($request);

            if ($transaction[0]) {
                return $this->CrudUpdatedResponse([] , [true, __('apps::dashboard.messages.updated')]);
            }

            return $this->updateError([] , [false  , $transaction[1] ?? __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return $this->updateError(null , [false, $e->errorInfo[2]]);
        }
    }

    public function multiAddOffer(Request $request)
    {
        if(!count((array)$request->ides)){
            return $this->updateError([] , [false  , __('apps::dashboard.messages.failed')]);
        }

        try {
            $transaction = $this->repository->multiAddOffer($request);

            if ($transaction[0]) {
                return response()->json([true]);
            }

            return $this->updateError([] , [false  , $transaction[1] ?? __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return $this->updateError(null , [false, $e->errorInfo[2]]);
        }
    }

    public  function multiCancelOffer(Request $request){

        if(!count((array)$request->ides)){
            return Response()->json([false,  __('apps::dashboard.messages.failed')]);
        }

        try {
            $transaction = $this->repository->multiCancelOffer($request);

            if ($transaction[0]) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false, $transaction[1] ?? __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function printInstallment($id)
    {
        $model = $this->repository->findById($id);

        return $this->view('components.print',compact('model'));
    }

    protected function createdResponse($model, $data)
    {
        $data['print_url'] = url(route('dashboard.installments.print' , $model->id));
        $data['blank'] = true;
        return $this->CrudCreatedResponse($model , $data);
    }

    protected function updatedResponse($model, $data)
    {
        $data['print_url'] = url(route('dashboard.installments.print' , $model->id));
        $data['blank'] = true;
        return $this->CrudUpdatedResponse($model , $data);
    }
}
