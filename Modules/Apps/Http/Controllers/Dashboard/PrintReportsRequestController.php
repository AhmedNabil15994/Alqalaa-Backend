<?php

namespace Modules\Apps\Http\Controllers\Dashboard;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class PrintReportsRequestController extends Controller
{
    use CrudDashboardController{
        __construct as __crudConstruct;
    }

    function __construct()
    {
        $this->__crudConstruct();
    }
}
