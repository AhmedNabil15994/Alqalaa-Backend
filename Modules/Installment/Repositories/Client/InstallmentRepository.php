<?php

namespace Modules\Installment\Repositories\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Installment\Entities\Client\Installment;

class InstallmentRepository
{
    private $transaction;
    private $model;

    public function __construct()
    {
        $this->model = new Installment;
        $this->transaction = new InstallmentTransactionRepository;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $record = $this->model->active()->orderBy($order, $sort)->get();
        return $record;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $record = $this->model->orderBy($order, $sort)->get();
        return $record;
    }

    public function findById($id)
    {
        $model = $this->model->findOrFail($id);
        return $model;
    }

    public function findValidToPayId($id)
    {
        $model = $this->model->ValidToPay()->findOrFail($id);
        return $model;
    }

    public function createInstallment(Request $request, $id){

        DB::beginTransaction();
        $model = $this->findValidToPayId($id);

        try {
            if(!$model)
                return false;

            $transaction = $this->transaction->createTransaction($request->pay_now);
            $transaction->instalments()->attach($model->id , [
                'amount' => $request->pay_now
            ]);

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request)
    {
        $transaction = $this->transaction->findValidToUpdateById($request['MerchUdf1']);
        DB::beginTransaction();

        try {
            if (isset($request['Status']) && $request['Status'] == '1') {

                foreach ($transaction->clientInstallments as $model){

                    $contract = $model->contract;
                    $model->payments()->create([
                        'amount' => $transaction->amount,
                        'transaction_date' => Carbon::now()->toDateString(),
                    ]);

                    if ($model->remaining == $transaction->amount) {
                        $model->update([
                            'transaction_date' => Carbon::now()->toDateString(),
                        ]);
                    }

                    $model->decrement('remaining', $transaction->amount);
                    $model->increment('paid', $transaction->amount);
                    $model->refresh();

                    $notPaid = $contract->installments()->where('remaining', '>', 0)->count();

                    if ($model->remaining == 0 && !$notPaid) {
                        $contract->update(['completed_at' => Carbon::now()->toDateString()]);
                    }
                }

            }else{
                $transaction->paid = 0;
            }

            $transaction->response = $request;
            $transaction->save();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
