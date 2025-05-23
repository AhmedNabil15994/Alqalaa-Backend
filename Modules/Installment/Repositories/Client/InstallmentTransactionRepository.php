<?php

namespace Modules\Installment\Repositories\Client;

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
        $model = $this->model->ValidToUpdate()->findOrFail($id);
        return $model;
    }

    /**
     * @param $amount
     * @param null $paid
     * @return bool
     */
    public function createTransaction($amount , $paid = null)
    {
        DB::beginTransaction();

        try {

            $transaction = $this->model->create([
                'amount' => $amount,
                'paid' => $paid,
                'token' => $this->generateToken(),
            ]);

            DB::commit();
            return $transaction;
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
