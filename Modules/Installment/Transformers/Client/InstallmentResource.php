<?php

namespace Modules\Installment\Transformers\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contract\Transformers\Client\LiteContractResource;

class InstallmentResource extends JsonResource
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
            'contract_id' => $this->contract_id,
            'contract_number' => optional($this->contract)->contract_number,
            'contract' => new LiteContractResource($this->contract),
            'amount' => number_format($this->amount,1),
            'remaining' => number_format($this->remaining,1),
            'paid' => number_format($this->paid,1),
            'due_date' => $this->due_date,
            'transaction_date' => $this->transaction_date,
            'note' => $this->note,
            'status' => $this->status,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
