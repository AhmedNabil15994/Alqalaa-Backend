<?php

namespace Modules\Indebtednes\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Indebtednes\Http\Requests\Dashboard\PayIndebtednesRequest;

class IndebtednesReportController extends Controller
{
    use CrudDashboardController{
        __construct as __crudConstruct;
    }

    public function __construct()
    {
        $this->__crudConstruct();
        $this->setViewPath('indebtednes::dashboard.indebtednes-reports');
    }
}
