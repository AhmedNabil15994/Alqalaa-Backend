<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;

class MonthPercentage extends Model 
{
    use CrudModel;

    protected $table = 'month_percentages';
    public $timestamps = true;
    protected $fillable = array('month_number', 'presentage','status');

    public function invoices()
    {
        return $this->hasMany(Contract::class);
    }

}