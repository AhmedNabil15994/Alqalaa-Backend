<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model 
{

    protected $table = 'client_phones';
    public $timestamps = true;
    protected $fillable = array('client_id', 'phone');

    public function client()
    {
        return $this->belongsTo('Modules\User\Entities\Client');
    }

}