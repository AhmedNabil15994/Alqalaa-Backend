<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contract\Entities\Contract;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Contract\Entities\ContractLineTypes;

class ContractLine extends Model
{
    protected $guarded = ['id'];
    protected $table = 'contract_lines';

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function type()
    {
        return $this->belongsTo(ContractLineTypes::class, 'contract_line_type_id', 'id');
    }
}
