<?php

namespace Modules\Installment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contract\Entities\Contract;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Installment\Traits\Models\InstallmentTrait;

class Installment extends Model
{
    use InstallmentTrait,CrudModel;

    protected $table = 'installments';
    public $timestamps = true;
    protected $fillable = array('contract_id', 'amount', 'remaining', 'paid', 'due_date','note' ,'transaction_date','price_before_offer','offer_percentage','sent_count');
    protected $casts = [
        'amount' => 'decimal:3',
        'remaining' => 'decimal:3',
        'paid' => 'decimal:3',
        'price_before_offer' => 'decimal:3',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('installment', function (Builder $builder) {
            $builder->whereHas('contract' , function ($q){
                $q->CanPayInstallmentScope()->where('type' , 'contract');
            });
        });
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
