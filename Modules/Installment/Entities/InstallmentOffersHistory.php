<?php

namespace Modules\Installment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;

class InstallmentOffersHistory extends Model 
{
    use CrudModel;
    
    protected $table = 'installment_offers_history';
    public $timestamps = true;
    protected $fillable = array('installment_id', 'amount', 'remaining', 'paid', 'offer_percentage');
    protected $casts = [
        'amount' => 'float',
        'remaining' => 'float',
        'paid' => 'float',
    ];

    public function installment()
    {
        return $this->belongsTo('Modules\Installment\Entities\Installment');
    }
}