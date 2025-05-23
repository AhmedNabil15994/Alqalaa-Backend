<?php

namespace Modules\Contract\Entities;

use Carbon\Carbon;
use Modules\Log\Entities\Activity;
use Illuminate\Database\Eloquent\Model;
use Modules\Contract\Scopes\ContractScope;
use Modules\Contract\Entities\ContractLine;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Installment\Entities\Installment;
use Modules\Installment\Entities\InstallmentPayment;

class Contract extends Model
{

    protected $table = 'contracts';

    use SoftDeletes , CrudModel;

    protected $dates = ['deleted_at','transaction_date','completed_at'];
    protected $casts = [
        'status' => 'array',
        'price' => 'decimal:3',
        'down_payment' => 'decimal:3',
        'remaining' => 'decimal:3',
        'installment_fees' => 'decimal:3',
        'installment_with_fees' => 'decimal:3',
        'installment_value' => 'decimal:3',
    ];
    protected $fillable = array(
        'status',
        'note',
        'client_id',
        'month_percentage_id',
        'contract_number',
        'transaction_date',
        'price', // قيمة العقد الأصلية
        'down_payment', // المقدم
        'remaining', // المتبقي من القيمة الرئيسية
        'installment_fees', // رسوم التقسيط
        'installment_with_fees', // المتبقي بعد إضافة قيمة القسط
        'months_num', // عدد الأشهر
        'installment_value', // قيمة القسط
        'completed_at'
    );

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ContractScope);
    }

    public function client()
    {
        return $this->belongsTo('Modules\User\Entities\Client');
    }

    public function installments()
    {
        return $this->hasMany('Modules\Installment\Entities\Installment');
    }

    public function NotComplatedInstallments()
    {
        return $this->hasMany('Modules\Installment\Entities\Installment')->Unpaid();
    }

    public function lateInstallments()
    {
        return $this->hasMany('Modules\Installment\Entities\Installment')->Late();
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

    public function getProfitAttribute()
    {
        return $this->installment_with_fees - $this->remaining;
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

    public function getInstallmentRemainingCountAttribute()
    {
        return $this->installments()->whereNull('transaction_date')->count();
    }

    public function getIsValidToEditAttribute()
    {
        return $this->transaction_date > Carbon::now() || (isset($this->status['is_active']) && $this->status['is_active'] == 0);
    }

    public function getCanPayInstallmentAttribute()
    {
        return $this->status == null || (isset($this->status['is_active']) && $this->status['is_active'] == 1);
    }

    public function getIsPendingForReviewAttribute()
    {
        return $this->status != null && (isset($this->status['is_active']) && $this->status['is_active'] != 1);
    }

    public function creationEmployee()
    {
        return $this->hasOne(Activity::class,'subject_id')->where([
            'subject_type' => Contract::class,
            'description' => 'created'
            ])->oldest();
    }

    public function getCreatedUserAttribute()
    {
        return optional(Activity::where([
            'subject_type' => Contract::class,
            'subject_id' => $this->id,
            'description' => 'created',
        ])->oldest()->first())->causer;
    }

    public function scopeValidToEdit($query)
    {
        return $query->whereDate('transaction_date' , '>' , Carbon::now()->toDateString())->orWhere('status->is_active' , 0);
    }

    public function scopeCanPayInstallmentScope($query)
    {
        return $query->where(function($query){
            $query->whereNull('status')->orWhere('status->is_active' , 1);
        });
    }

    public function scopePendingForReview($query)
    {
        return $query->where('status->is_active' , 0);
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

    public function scopeclientContracts($query)
    {
        return $query->where('client_id' , auth('client')->user()->id);
    }

    public function scopeLate($query)
    {
        return $query->whereHas('installments' , function ($q) {
            $q->where('remaining','>',0)
                ->whereDate('due_date' ,'<', Carbon::now()->toDateString());
        });
    }

    public function lines()
    {
        return $this->hasMany(ContractLine::class);
    }
}
