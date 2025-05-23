<?php

namespace Modules\Contract\Repositories\Dashboard;

use Modules\Contract\Entities\MonthPercentage;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class MonthPercentageRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(MonthPercentage::class);
        $this->setQueryActionsCols([
            '#' => 'id',
            __('contract::dashboard.month-percentages.datatable.month_number') => 'month_number',
            __('contract::dashboard.month-percentages.datatable.presentage') => 'presentage',
            __('contract::dashboard.month-percentages.datatable.status') => 'status_title',
            __('contract::dashboard.month-percentages.datatable.created_at') => 'created_at',
        ]);
    }
}
