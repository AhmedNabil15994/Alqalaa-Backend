<?php

namespace Modules\Indebtednes\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class IndebtednesReportResource extends JsonResource
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
            'indebt_number' => $this->indebtednes->indebt_number,
            'indebtednes' => new IndebtednesResource($this->indebtednes),
            'amount' => number_format($this->amount,1),
            'remaining' => number_format($this->remaining,1),
            'paid' => number_format($this->paid,1),
            'due_date' => $this->due_date,
            'transaction_date' => $this->transaction_date ? date('d-m-Y', strtotime($this->transaction_date)) : '',
            'note' => $this->note,
            'status' => $this->status,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
