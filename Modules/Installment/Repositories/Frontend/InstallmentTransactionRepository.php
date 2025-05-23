<?php

namespace Modules\Installment\Repositories\Frontend;

use Modules\Installment\Entities\InstallmentTransaction;

class InstallmentTransactionRepository
{
    public $model;
    
    public function __construct()
    {
        $this->model = new InstallmentTransaction;
    }

    public function checkInsalmentsValidAmount($model)
    {
        if($model){
            foreach($model->instalments()->get(['remaining']) as $instalment){
                if($instalment->remaining < $instalment->pivot->amount){
                    return null;
                }
            }
        }

        return $model;
    }

    public function findValidToUpdateById($id)
    {
        $model = $this->checkInsalmentsValidAmount($this->model->ValidToUpdate()->find($id));
        return $model;
    }

    public function find($id)
    {
        $model = $this->model->find($id);
        return $model;
    }

    public function findValidToUpdateByToken($token)
    {
        $model = $this->checkInsalmentsValidAmount($this->model->ValidToUpdate()->where('token' , $token)->first());
        return $model;
    }

    public function findPaiedByToken($token)
    {
        return $this->model->Paid()->where('token' , $token)->first();
    }
}
