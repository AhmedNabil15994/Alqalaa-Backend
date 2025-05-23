<?php

namespace Modules\Apps\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Apps\Traits\DashboardQueries;
use Modules\Apps\Transformers\Dashboard\ChartDayResource;

class FrontendController extends Controller
{

    public function index()
    {
        return view('apps::frontend.index');
    }
}
