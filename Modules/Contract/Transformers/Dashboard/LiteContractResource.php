<?php

namespace Modules\Contract\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class LiteContractResource extends JsonResource
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
            'client_name' => optional($this->client)->name,
            'price' => auth()->user()->can('show_contract_amount') ? number_format($this->price,1) : null,
            'down_payment' => auth()->user()->can('show_contract_down_payment') ? number_format($this->down_payment,1) : null,
            'remaining' => number_format($this->remaining,1),
            'installment_fees' => auth()->user()->can('show_installment_fees') ? number_format($this->installment_fees,1) : null,
            'installment_with_fees' => number_format($this->installment_with_fees,1),
            'months_num' => $this->months_num,
            'installment_value' => number_format($this->installment_value,1),
            'paid' => auth()->user()->can('show_contract_paid_amount') ? number_format($this->total_installment_paid,1) : null,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
