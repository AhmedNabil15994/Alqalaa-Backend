<?php

namespace Modules\Casee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\User\Entities\Client;

class CaseAction extends Model
{

    use SoftDeletes,CrudModel;

    protected $table = 'case_actions';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array('client_id', 'description','price','paid');

//    public function indebtednes()
//    {
//        return $this->hasOne('Modules\Indebtednes\Entities\Indebtednes');
//    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}