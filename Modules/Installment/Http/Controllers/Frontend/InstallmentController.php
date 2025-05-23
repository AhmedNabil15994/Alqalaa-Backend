<?php

namespace Modules\Installment\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Installment\Repositories\Frontend\InstallmentRepository;
use Modules\Installment\Repositories\Frontend\InstallmentTransactionRepository;
use Modules\Transaction\Services\CbkPaymentService;

class InstallmentController extends Controller
{
    private $instalmentRepository;
    private $repository;
    private $payment;

    public function __construct(InstallmentTransactionRepository $repository, InstallmentRepository $instalmentRepository)
    {
        $this->repository = $repository;
        $this->instalmentRepository = $instalmentRepository;
        $this->payment = new CbkPaymentService();
    }

    public function index($token)
    {
        $transaction = $this->repository->findValidToUpdateByToken($token);

        if (!$transaction) {
            $transaction = $this->repository->findPaiedByToken($token);

            if($transaction){

                $transaction = ['status' => 1, 'msg' => 'Payment paid successfully', 'data' => $transaction];
            }else{
                $transaction = ['status' => 2, 'msg' => __("Payment transaction has expired"), 'data' => $transaction];
            }
            return view('installment::frontend.transaction-results' ,compact('transaction'));
        }else{

        }

        return view('installment::frontend.checkout', compact('transaction'));
    }

    protected function pay($token, $id)
    {
        $transaction = $this->repository->findValidToUpdateByToken($token);

        if (!$transaction || $transaction->id != $id) {
            abort(404);
        }

        return redirect()->away($this->payment->send($transaction, $transaction->id));
    }


    public function webHooks(Request $request)
    {
        $data = $this->payment->verifyPayment($request->encrp);
        $transaction = $this->instalmentRepository->update($data);

        return view('installment::frontend.transaction-results' ,compact('transaction'));
    }


    public function printInstallment($id)
    {
        $model = $this->instalmentRepository->findById($id);
        return view('installment::client.installments.components.print',compact('model'));
    }
}
