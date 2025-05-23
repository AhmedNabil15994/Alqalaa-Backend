<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;

class ContractStatus extends Model
{
    use HasTranslations;
    protected $table = 'contract_statuses';
    public $translatable = ['title'];

    use  CrudModel;
    protected $fillable = array(
        'title',
        'is_pending',
        'is_active',
    );

    public function getContractDataAttribute()
    {
        return [
            'id' => $this->id,
            'is_active' => $this->is_active,
            'title' => [
                'en' => $this->getTranslation('title','en'),
                'ar' => $this->getTranslation('title','ar'),
            ],
        ];
    }
    public function scopepending($query)
    {
        return $query->where('is_pending', true);
    }

    public function scopeactive($query)
    {
        return $query->where('is_active', true);
    }
}
