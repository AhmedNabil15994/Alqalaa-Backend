<?php

namespace Modules\Indebtednes\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class IndebtednesResource extends JsonResource
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
            'indebt_number' => $this->indebt_number,
            'indebtednes_id' => $this->contract_id,
            'client_id' => optional($this->client)->name,
            'price' => $this->price,
            'remaining' => $this->total_installment_remaining,
            'paid' => number_format($this->total_paid,1),
            'is_case_action' => $this->is_case_action,
            'details' => $this->note,
            'completed_at' => $this->completed_at ?  date('d-m-Y', strtotime($this->completed_at)) : null,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'options' => view('indebtednes::dashboard.indebtednes.components.table-options', ['model' => $this])->render(),
        ];
    }
}
