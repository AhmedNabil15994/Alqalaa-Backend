<?php

namespace Modules\Installment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Installment\Entities\Client\Installment as ClientInstallment;
use Modules\Core\Traits\Dashboard\CrudModel;

class InstallmentTransaction extends Model
{
    use CrudModel;

    protected $table = 'installment_transactions';
    public $timestamps = true;
    protected $fillable = array('installment_id', 'amount', 'paid','response','token','user_id');
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function instalments()
    {
        return $this->belongsToMany(Installment::class ,'installment_pivot_transaction','transaction_id','installment_id')
            ->withPivot('amount');
    }

    public function clientInstallments()
    {
        return $this->belongsToMany(ClientInstallment::class ,'installment_pivot_transaction','transaction_id','installment_id');
    }

    public function scopeInProcess($query)
    {
        return $query->whereNull('paid');
    }

    public function scopeTransactionDone($query)
    {
        return $query->whereNotNull('paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('paid' , 0);
    }

    public function scopePaid($query)
    {
        return $query->where('paid' , 1);
    }

    public function scopeValidToUpdate($query)
    {
        return $query->has('instalments')->whereNull('paid');
    }
}
