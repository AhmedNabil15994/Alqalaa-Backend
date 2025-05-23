<?php

namespace Modules\Apps\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\User\Entities\User;

class PrintReportsRequest extends Model
{
    use CrudModel;

    protected $fillable = ['user_id', 'status','type', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
