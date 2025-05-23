<?php

namespace Modules\Installment\Repositories\Dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Installment\Entities\InstallmentTransaction;

class InstallmentTransactionRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(InstallmentTransaction::class);
    }

    public function findValidToUpdateById($id)
    {
        $model = $this->model->ValidToUpdate()->find($id);
        return $model;
    }

    /**
     * @param $amount
     * @param null $paid
     * @return bool
     */
    public function createTransaction($amount, $paid = null,$user_id = null,$installment_id = null)
    {
        DB::beginTransaction();

        try {
            $transaction = $this->model->where([
                ['installment_id', $installment_id],
                ['paid', $paid],
                ['amount', $amount],
            ])->whereBetween('created_at',[date('Y-m-d 06:00:00'),date('Y-m-d 17:59:59')])->latest('id')->first();

            if($transaction){
                $transaction->update(['token' => $this->generateToken()]);
            }else{
                $transaction = $this->model->create([
                    'amount' => $amount,
                    'paid' => $paid,
                    'user_id' => auth()->check() ? auth()->user()->id : $user_id,
                    'token' => $this->generateToken(),
                    'installment_id'    => $installment_id,
                ]);
            }
            DB::commit();
            $transaction->refresh();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
    public function removeOldClientTransactions($clientId,$ignoredTransactionId)
    {
        DB::beginTransaction();

        try {

            $this->model->ValidToUpdate()->where('id','!=',$ignoredTransactionId)
            ->whereHas('instalments', function($query) use($clientId){

                $query->whereHas('contract', function($query) use($clientId){
                    $query->where('client_id',$clientId);
                });

            })->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    private function generateToken(){
        $token = Str::random(50);
        if($this->model->where('token' , $token)->count())
            return $this->generateToken();

        return $token;
    }
}
