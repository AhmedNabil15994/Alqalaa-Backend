<?php

namespace Modules\Indebtednes\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IndebtednesReport extends Model
{

    protected $table = 'installments';
    public $timestamps = true;
    protected $fillable = array('contract_id', 'amount', 'remaining', 'paid', 'due_date','note' ,'transaction_date');
    protected $casts = [
        'amount' => 'float',
        'remaining' => 'float',
        'paid' => 'float',
    ];
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('indebtednes_report', function (Builder $builder) {
            $builder->whereHas('indebtednes' , function ($q){
                $q->where('type' , 'indebtednes');
            });
        });
    }

    public function indebtednes()
    {
        return $this->belongsTo(Indebtednes::class , 'contract_id');
    }

    public function getIsCompleteAttribute()
    {
        if ($this->transaction_date != null && $this->remaining > 0)
            return true;

        return false;
    }


    public function getStatusAttribute()
    {
        if ($this->transaction_date != null) {

            return 'completed';

        } else {
            return 'waiting';
        }
    }
    public function scopeLate($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $query->whereNull('transaction_date')
            ->where('due_date', '<=', $now);
    }

    public function scopeUnpaid($query)
    {
        $query->whereNull('transaction_date');
    }

    public function scopeUpcoming($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $afterWeek = Carbon::now()->addWeek()->format('Y-m-d');
        $query->whereBetween('due_date', [$now, $afterWeek])
            ->whereNull('transaction_date');
    }
}