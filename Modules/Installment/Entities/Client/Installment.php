<?php

namespace Modules\Installment\Entities\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Installment\Traits\Models\InstallmentTrait;

class Installment extends Model
{
    use InstallmentTrait;

    protected $table = 'installments';
    public $timestamps = true;
    protected $fillable = array('remaining', 'paid' ,'transaction_date');
    protected $casts = [
        'amount' => 'decimal:2',
        'remaining' => 'decimal:2',
        'paid' => 'decimal:2',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('client_installment', function (Builder $builder) {
            $builder->whereHas('contract' , function ($q){
                $q->CanPayInstallmentScope()->where('type' , 'contract')->where('client_id' , optional(auth('client')->user())->id);
            });
        });
    }

    public function contract()
    {
        return $this->belongsTo('Modules\Contract\Entities\Client\Contract');
    }
}
