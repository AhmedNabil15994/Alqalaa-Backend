<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Catalog\Entities\Label;
use Modules\Catalog\Entities\Nationality;
use Modules\Contract\Entities\Contract;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\DeviceToken\Traits\HasApiTokens;
use Modules\Indebtednes\Entities\Indebtednes;
use Modules\Installment\Entities\Installment;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Authenticatable implements HasMedia
{
    use CrudModel {
        __construct as CrudConstruct;
    }

    use HasApiTokens, SoftDeletes, HasFactory, Notifiable, HasTranslations, InteractsWithMedia;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->CrudConstruct();
        $this->concatCols = [
            'name' => [
                'name',
                'national_ID',
            ]
        ];
    }

    protected $table = 'clients';
    protected $guard_name = 'client';
    protected $dates = ['deleted_at'];
    protected $fillable = array('nationality_id', 'name', 'national_ID', 'email', 'password', 'is_judging', 'status', 'user_name','work_info');
    public $translatable = ['name'];


    public function labels()
    {
        return $this->morphToMany(Label::class , 'labelable');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function phones()
    {
        return $this->hasMany(ClientPhone::class);
    }

    public function phone()
    {
        return $this->hasOne(ClientPhone::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function invoices()
    {
        return $this->hasMany(Contract::class);
    }

    public function installments()
    {
        return $this->hasManyThrough(Installment::class, Contract::class);
    }

    public function indebtedness()
    {
        return $this->hasMany(Indebtednes::class);
    }

    public function getLastIndebtednesAttribute()
    {
        return $this->indebtedness()->latest()->first();
    }

    /**
     * name : is_credentials_changed
     * @return bool
     */
    public function getIsCredentialsChangedAttribute()
    {
        return ($this->national_ID == $this->user_name);
    }

    /**
     * name : is_credentials_changed
     * @return bool
     */
    public function getSelectorNameAttribute()
    {
        return ($this->name .' - '. $this->national_ID);
    }


    public function scopeActive($query)
    {
        return $query->where(['status' => true, 'is_judging' => false]);
    }


    public function scopeJudging($query)
    {
        return $query->where(['is_judging' => true]);
    }
}