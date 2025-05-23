<?php

namespace Modules\Indebtednes\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Indebtednes\Scopes\IndebtedScope;
use Modules\Core\Traits\Dashboard\CrudModel;

class Indebtednes extends Model
{
    protected $table = 'contracts';
    public $timestamps = true;

    use SoftDeletes , CrudModel;

    protected $dates = ['deleted_at','transaction_date','completed_at'];
    protected $fillable = array(
        'client_id',
        'transaction_date',
        'price', // قيمة العقد الأصلية
        'remaining',
        'note',
        'indebt_number',
        'completed_at'
    );
    protected $casts = [
        'price' => 'float',
        'remaining' => 'float',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new IndebtedScope);
    }

    public function client()
    {
        return $this->belongsTo('Modules\User\Entities\Client');
    }

    public function installments()
    {
        return $this->hasMany(IndebtednesReport::class, 'contract_id');
    }

    public function getPaidAttribute()
    {
        return $this->installments()->where('transaction_date', '!=', null)->get();
    }

    public function getTotalPaidAttribute()
    {
        return $this->installments()->sum('paid');
    }

    public function getTotalInstallmentRemainingAttribute()
    {
        return $this->price - $this->installments()->sum('paid');
    }

    public function getInstallmentPaidCountAttribute()
    {
        return $this->installments()->whereNotNull('transaction_date')->count();
    }

    public function getIsValidToEditAttribute()
    {
        return !$this->installments()->count();
    }

    public function getIsCaseActionAttribute()
    {
        return $this->case_action_id;
    }

    public function scopeValidToEdit($query)
    {
        return $query->doesnthave('installments');
    }

    public function scopeCaseAction($query)
    {
        return $query->whereNotNull('case_action_id');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at')->first();
    }

    public function scopeUnCompleted($query)
    {
        return $query->whereNull('completed_at')->first();
    }
}