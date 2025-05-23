<?php

namespace Modules\User\Entities;

use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\DeviceToken\Traits\HasApiTokens;

class User extends Authenticatable implements HasMedia
{
    use CrudModel{
        __construct as private CrudConstruct;
    }

    use Notifiable , HasRoles , InteractsWithMedia,HasApiTokens;

    use SoftDeletes {
      restore as private restoreB;
    }
    protected $guard_name = 'web';
    protected $dates = [
      'deleted_at'
    ];

    protected $fillable = [
        'name', 'email', 'password', 'mobile' , 'image'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setLogAttributes(['name', 'email', 'password', 'mobile' , 'image']);

    }

    public function restore()
    {
        $this->restoreB();
    }

}
