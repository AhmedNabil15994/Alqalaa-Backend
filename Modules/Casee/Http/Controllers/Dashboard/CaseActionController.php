<?php

namespace Modules\Casee\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Casee\Entities\CaseActions;
use Modules\Casee\Repositories\Dashboard\CaseActionRepository;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class CaseActionController extends Controller
{
    use CrudDashboardController{
        __construct as private __crudConstruct;
    }

    public function __construct()
    {
        $this->__crudConstruct();
        $this->setViewPath('casee::dashboard.case-actions');
    }

//    public function index(Request $request)
//    {
//        $routeName = $request->
//    }
}
