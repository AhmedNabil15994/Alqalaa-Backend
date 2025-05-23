<?php

namespace Modules\Contract\Transformers\Client;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'remaining' => number_format(($this->installment_with_fees - $this->total_paid),1),
            'installment_with_fees' => number_format($this->installment_with_fees,1),
            'months_num' => $this->months_num,
            'installment_value' => number_format($this->installment_value,1),
            'paid' => number_format($this->total_paid,1),
            'completed_at' => $this->completed_at ?  date('d-m-Y', strtotime($this->completed_at)) : null,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
