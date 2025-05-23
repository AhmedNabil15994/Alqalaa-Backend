<?php

namespace Modules\Installment\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Installment\Entities\Client\Installment;
use Modules\Installment\Http\Requests\Client\InstallmentRequest;
use Modules\Transaction\Services\CbkPaymentService;
use Modules\Transaction\Services\UPaymentService;

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
        $this->folder = 'client';
        $this->__crudConstruct();
        $this->setModel(Installment::class);
    }

    public function createInstallment(InstallmentRequest $request , $id)
    {

        if(auth('client')->user()->is_judging == 1){
            return response()->json([],400);
        }

        try {
            $transaction = $this->repository->createInstallment($request,$id);

            if ($transaction) {

                $payment = route('frontend.instalment.checkout', $transaction->token);
                return $this->updatedResponse($transaction , [true,__('contract::client.contracts.show.message.please_wait_for_redirect_get_way'),'url' => $payment]);
            }

            return $this->updateError($transaction , [false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {

            return $this->updateError(null , [false, $e->errorInfo[2]]);
        }
    }

    public function webHooks(Request $request)
    {
        dd('fd');
         logger($request->all());
        $data = $this->payment->verifyPayment($request->encrp);
        $this->repository->update($data);
    }

    public function success(Request $request)
    {

        $model = $this->repository->update($request);
        session()->flash('success' ,  __('apps::dashboard.messages.updated'));
        return redirect(route('client.contracts.index'));
    }

    public function failed(Request $request)
    {
        $model = $this->repository->update($request);
        session()->flash('error' , __('apps::dashboard.messages.failed'));
        return redirect(route('client.contracts.index'));
    }

    public function printInstallment($id)
    {
        $model = $this->repository->findById($id);
        return $this->view('components.print',compact('model'));
    }
}
