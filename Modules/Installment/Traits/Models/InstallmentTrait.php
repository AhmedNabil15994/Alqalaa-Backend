<?php


namespace Modules\Installment\Traits\Models;


use Carbon\Carbon;
use Modules\Installment\Entities\InstallmentOffersHistory;
use Modules\Installment\Entities\InstallmentTransaction;

trait InstallmentTrait
{
    public function payments()
    {
        return $this->hasMany('Modules\Installment\Entities\InstallmentPayment');
    }

    public function offersHistory()
    {
        return $this->hasOne(InstallmentOffersHistory::class,'installment_id');
    }

    public function transactions()
    {
        return $this->belongsToMany(InstallmentTransaction::class ,'installment_pivot_transaction','installment_id','transaction_id');
    }

    public function getIsCompleteAttribute()
    {
        if ($this->transaction_date != null && $this->remaining > 0)
            return true;

        return false;
    }

    public function getStatusAttribute()
    {
        if ($this->payments()->count() && $this->remaining > 0) {

            return 'not_complete';

        } elseif ($this->transaction_date != null && $this->remaining == 0) {

            return 'completed';

        } else {
            return 'waiting';
        }
    }

    public function getValidToPayAttribute()
    {
//        if($this->has('transactions') && $this->transactions()->InProcess()->count()){
//            return false;
//        }

        return true;
    }

    public function scopeLate($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        return $query->whereNull('transaction_date')
            ->where('due_date', '<=', $now);
    }

    public function scopeUnpaid($query)
    {
        return $query->whereNull('transaction_date');
    }

    public function scopeValidToPay($query)
    {
        return $query->where(function ($q) {
//            $q->whereDoesntHave('transactions' , function ($q){
//                $q->InProcess();
//            })->orDoesntHave('transactions');
        })->whereNull('transaction_date');
    }

    public function scopeUpcoming($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $afterWeek = Carbon::now()->addWeek()->format('Y-m-d');
        return $query->whereBetween('due_date', [$now, $afterWeek])
            ->whereNull('transaction_date');
    }
}