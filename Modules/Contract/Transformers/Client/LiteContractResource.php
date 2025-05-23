<?php

namespace Modules\Contract\Transformers\Client;

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
            'price' => number_format($this->price,1),
            'down_payment' => number_format($this->down_payment,1),
            'remaining' => number_format($this->remaining,1),
            'installment_fees' => number_format($this->installment_fees,1),
            'installment_with_fees' => number_format($this->installment_with_fees,1),
            'months_num' => $this->months_num,
            'installment_value' => number_format($this->installment_value,1),
            'paid' => number_format($this->total_installment_paid,1),
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
