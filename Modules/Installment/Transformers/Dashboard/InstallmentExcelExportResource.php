<?php

namespace Modules\Installment\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contract\Transformers\Dashboard\LiteContractResource;

class InstallmentExcelExportResource extends JsonResource
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
            'client_name' => ((array)json_decode($this->client_name))[locale()],
            'contract_number' => $this->contract_number,
            'phone' => $this->phone,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'remaining' => $this->remaining,
            'percentage' => strip_tags($this->percentage),
            'due_date' => $this->due_date,
            'transaction_date' => $this->transaction_date,
            'status' => strip_tags($this->status),
        ];
    }
}
