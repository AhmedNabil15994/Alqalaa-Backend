<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Area\Entities\State;
use Modules\Contract\Entities\Contract;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\Indebtednes\Entities\Indebtednes;
use Modules\Installment\Entities\Installment;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Address extends Model
{

    protected $table = 'addresses';

    use CrudModel;

    protected $dates = ['deleted_at'];
    protected $fillable = array('state_id', 'street');
    public $translatable = ['name'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}