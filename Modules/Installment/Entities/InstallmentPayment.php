<?php

namespace Modules\Installment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;
use Modules\Core\Traits\Dashboard\CrudModel;

class InstallmentPayment extends Model 
{
    use CrudModel;

    protected $table = 'installment_payments';
    public $timestamps = true;
    protected $fillable = array('installment_id', 'amount', 'note', 'transaction_date','pay_by_type','pay_by_id');
    protected $casts = [
        'amount' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pay_by_id');
    }

    public function installment()
    {
        return $this->belongsTo('Modules\Installment\Entities\Installment');
    }

}