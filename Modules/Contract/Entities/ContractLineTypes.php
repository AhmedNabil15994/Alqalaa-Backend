<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractLineTypes extends Model
{
    use CrudModel, SoftDeletes, HasTranslations;
    protected $guarded = ['id'];
    protected $table = 'contract_line_types';
    public $translatable = ['title'];
}
