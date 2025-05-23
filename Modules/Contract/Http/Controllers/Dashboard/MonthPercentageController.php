<?php

namespace Modules\Contract\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class MonthPercentageController extends Controller
{
    use CrudDashboardController{
        __construct as private CrudConstruct;
    }
    public function __construct()
    {
        $this->CrudConstruct();
        $this->setViewPath('contract::dashboard.month-percentages');
    }

    public function getById($id){
        return response()->json($this->repository->findById($id));
    }
}
