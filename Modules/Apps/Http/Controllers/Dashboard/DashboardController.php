<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Apps\Traits\DashboardQueries;
use Modules\Apps\Transformers\Dashboard\ChartDayResource;

class DashboardController extends Controller
{
    use DashboardQueries;

    public function index()
    {
        return view('apps::dashboard.index');
    }

    public function chart(Request $request)
    {
        $request->merge(['req' => $request->all()]);
        $totalPaid = $this->getTotalPaid($request)->get();
        $totalPrice = $this->getTotalPrice($request);
        $data = [
            'contract_count' => $this->getContractCount($request)->count(),
            'completed_contract_count' => [
                'count' => $this->getCompletedContractCount($request),
            ],
            'un_completed_contract_count' => [
                'count' => $this->getUnCompletedContractCount($request),
            ],
            'late_contract_count' => [
                'count' => $this->getLateContractCount($request),
            ],
            'total_paid' => $totalPaid ? number_format($totalPaid->sum('total_installment_paid'),1) : 0,
            'total_profit' => number_format($this->getTotalProfit($request),1),
            'total_price' => $totalPrice ? number_format($totalPrice->sum('price'),1) : 0,
            // 'chart' => ChartDayResource::collection($this->dateRange($request))
        ];

        $data['completed_contract_count']['percentage'] = number_format(($data['contract_count'] ? $data['completed_contract_count']['count'] / $data['contract_count'] * 100 : 0),2);
        $data['un_completed_contract_count']['percentage'] =number_format(( $data['contract_count'] ? $data['un_completed_contract_count']['count'] / $data['contract_count'] * 100 : 0),2);
        $data['late_contract_count']['percentage'] = number_format(($data['contract_count'] ? $data['late_contract_count']['count'] / $data['contract_count'] * 100 : 0),2);

        return Response()->json($data);
    }

    public function dateRange(Request $request){

        $from = Carbon::createFromDate($request->from);
        $to = Carbon::createFromDate($request->to);
        $from = !$request->from ? (optional($this->query($request)->oldest()->first())->created_at ?? Carbon::now()->subDay()) : $from;
        $to = !$request->to ? Carbon::now() : $to;

        return $this->generateDateRange($from , $to);
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date){

        $dates = [];

        while ($start_date <= $end_date){

            $dates[] = (object)['date' => $start_date->toDateString()];
            $start_date->addDay();
        }

        return $dates;
    }
}
