<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\User\Entities\Client;
use Modules\User\Entities\User;

class Label extends Model
{
    use CrudModel, HasTranslations;

    protected $table = 'labels';
    protected $fillable = ['color', 'title'];
    public $translatable = ['title'];

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'labelable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'labelable');
    }


    public function getLabelTitleAttribute()
    {
        return "<span class=\"badge badge-success\" style=\"background-color:$this->color\">$this->title</span>";
    }

}
