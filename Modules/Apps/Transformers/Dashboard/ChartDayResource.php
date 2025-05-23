<?php

namespace Modules\Apps\Transformers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Apps\Traits\DashboardQueries;
use Modules\Installment\Repositories\Dashboard\InstallmentRepository;

class ChartDayResource extends JsonResource
{
    use DashboardQueries {
        __construct as TraitConstruct;
    }

    private $installments;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->TraitConstruct();
        $this->installments = new InstallmentRepository;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $totalPaid = $this->installments->QueryTable($request)->whereDate('transaction_date' , '=' , $this->date);
        $totalPrice = $this->getTotalPrice($request)->whereDate('transaction_date', '=', $this->date);
        return [
            'date' => $this->date,
            'contract_counts' => $this->getContractCount($request)->whereDate('transaction_date', '=', $this->date)->count(),
            'total_prices' => $totalPrice ? number_format($totalPrice->sum('price'),1) : 0,
            'total_paid' => $totalPaid ? number_format($totalPaid->sum('paid'),1) : 0,
        ];
    }
}
