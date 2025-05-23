<?php

namespace Modules\Installment\Repositories\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Installment\Entities\Installment;

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

    public function createInstallment(Request $request, $id)
    {

        DB::beginTransaction();
        $model = $this->findValidToPayId($id);

        try {
            if (!$model) {
                return false;
            }

            $transaction = $this->transaction->createTransaction($request->pay_now);
            $transaction->instalments()->attach($model->id, [
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
        try {

            if (isset($request['PayId'])) {
                $transaction = $this->transaction->findValidToUpdateById($request['PayId']);

                DB::beginTransaction();
                if ($transaction) {

                    if (isset($request['Status']) && $request['Status'] == '1') {
                        foreach ($transaction->instalments as $model) {

                            $contract = $model->contract;
                            $model->payments()->create([
                                'amount' => $model->pivot->amount,
                                'transaction_date' => Carbon::now()->toDateString(),
                                'pay_by_type' => 'by_link',
                                'pay_by_id' => $transaction->user_id ?? null,
                            ]);
                            if ($model->remaining == $model->pivot->amount) {
                                $model->update([
                                    'transaction_date' => Carbon::now()->toDateString(),
                                ]);
                            }
                            $model->decrement('remaining', $model->pivot->amount);
                            $model->increment('paid', $model->pivot->amount);
                            $model->refresh();
                            $notPaid = $contract->installments()->where('remaining', '>', 0)->count();
                            if ($model->remaining == 0 && !$notPaid) {
                                $contract->update(['completed_at' => Carbon::now()->toDateString()]);
                            }
                        }

                        $transaction->paid = 1;
                        $result = ['status' => 1, 'msg' => 'Payment paid successfully', 'data' => $transaction];

                    } else {
                        $transaction->paid = 0;
                        $result = ['status' => 2, 'msg' => 'Payment transaction canceled', 'data' => $transaction];
                    }

                    $transaction->response = $request;
                    $transaction->save();

                    DB::commit();
                    return $result;
                }
            }
            return ['status' => 0, 'msg' => 'Payment Failed', 'data' => null];

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
