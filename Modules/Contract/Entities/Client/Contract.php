<?php

namespace Modules\Contract\Entities\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Contract\Scopes\ContractScope;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Installment\Entities\Installment;
use Modules\Installment\Entities\InstallmentPayment;

class Contract extends Model
{

    protected $table = 'contracts';

    use SoftDeletes , CrudModel;

    protected $dates = ['deleted_at','transaction_date','completed_at'];
    protected $casts = [
        'price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'remaining' => 'decimal:2',
        'installment_fees' => 'decimal:2',
        'installment_with_fees' => 'decimal:2',
        'installment_value' => 'decimal:2',
    ];
    protected $fillable = array(
        'completed_at'
    );

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('client_contract', function (Builder $builder) {
            $builder->where('type', 'contract')->where('client_id' , optional(auth('client')->user())->id);
        });
    }

    public function client()
    {
        return $this->belongsTo('Modules\User\Entities\Client');
    }

    public function installments()
    {
        return $this->hasMany('Modules\Installment\Entities\Client\Installment');
    }

    public function payments()
    {
        return $this->hasManyThrough(InstallmentPayment::class , Installment::class);
    }

    public function monthPercentage()
    {
        return $this->belongsTo('Modules\Contract\Entities\MonthPercentage');
    }

    public function getPaidValueAttribute()
    {
        return $this->payments()->sum('paid');
    }

    public function getNextInstallmentAttribute()
    {
        return $this->installments()->oldest('due_date')->whereNull('transaction_date')->first();
    }

    public function getLastInstallmentAttribute()
    {
        return $this->installments()->latest('due_date')->first();
    }

    public function getPaidAttribute()
    {
        return $this->installments()->where('transaction_date', '!=', null)->get();
    }

    public function getTotalPaidAttribute()
    {
        return $this->installments()->sum('paid');
    }

    public function getTotalInstallmentPaidAttribute()
    {
        return $this->installments()->sum('paid');
    }

    public function getTotalInstallmentRemainingAttribute()
    {
        return $this->installments()->sum('remaining');
    }

    public function getInstallmentPaidCountAttribute()
    {
        return $this->installments()->whereNotNull('transaction_date')->count();
    }

    public function scopeCanPayInstallmentScope($query)
    {
        return $query->where(function($query){
            $query->whereNull('status')->orWhere('status->is_active' , 1);
        });
    }

    public function getInstallmentRemainingCountAttribute()
    {
        return $this->installments()->whereNull('transaction_date')->count();
    }

    public function scopeContract($query)
    {
        return $query->whereNotNull('completed_at')->first();
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    public function scopeUnCompleted($query)
    {
        return $query->whereNull('completed_at');
    }

    public function scopeLate($query)
    {
        return $query->whereHas('installments' , function ($q) {
            $q->where('remaining','>',0)
                ->whereDate('due_date' ,'<', Carbon::now()->toDateString());
        });
    }
}
