<?php

namespace Modules\Contract\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contract\Entities\Contract;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'contract_number' => $this->contract_number,
            'client_id' => optional($this->client)->name,
            'price' => number_format($this->price,1),
            'down_payment' => number_format($this->down_payment,1),
            'remaining' => number_format($this->remaining,1),
            'installment_fees' => number_format($this->installment_fees,1),
            'installment_with_fees' => number_format($this->installment_with_fees,1),
            'months_num' => $this->months_num,
            'overdue_amounts' => number_format($this->lateInstallments()->sum('remaining'),2),
            'installment_value' => number_format($this->installment_value,1),
            'paid' => number_format($this->total_installment_paid,1),
            'profit' => number_format($this->profit,1),
            'completed_at' => $this->completed_at ?  date('d-m-Y', strtotime($this->completed_at)) : null,
            'created_user' => optional($this->created_user)->name,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'options' => view('contract::dashboard.contracts.components.table-options', ['model' => $this])->render(),
        ];
    }
}
