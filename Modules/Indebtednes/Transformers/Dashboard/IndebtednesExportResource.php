<?php

namespace Modules\Indebtednes\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Indebtednes\Entities\Indebtednes;
use Modules\Indebtednes\Entities\IndebtednesReport;

class IndebtednesExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($request['req']['client_id']) || $request->client_id) {
            return [
                'id' => $this->id,
                'indebtednes_id' => $this->contract_id,
                'indebt_number' => $this->indebt_number,

                //named like this for sorting
                'client_id' => optional($this->client)->name,
                'phone' => optional(optional($this->client)->phone)->phone,
                'indebtednes_client_id' => optional($this->client)->id,
                'price' => $this->price,
                'remaining' => $this->total_installment_remaining,
                'paid' => $this->total_paid,
                'is_case_action' => $this->is_case_action,
                'details' => $this->note,
                'completed_at' => $this->completed_at ? date('d-m-Y', strtotime($this->completed_at)) : null,
                'created_at' => date('d-m-Y', strtotime($this->created_at)),
                'options' => view('indebtednes::dashboard.indebtednes.components.table-options', ['model' => $this])->render(),
            ];
        } else {
            $indebtednes = Indebtednes::where('client_id', $this->client_id);
            $installments = IndebtednesReport::whereIn('contract_id', $indebtednes->pluck('id')->toArray());
            $paid = $installments;
            $paid = $paid->sum('paid');
            $indebtednes = $indebtednes->sum('price');

            return [
                'id' => $this->id,
                'indebtednes_id' => $this->contract_id,
                'indebt_number' => $this->indebt_number,

                //named like this for sorting
                'client_id' => optional($this->client)->name,
                'phone' => optional(optional($this->client)->phone)->phone,
                'indebtednes_client_id' => optional($this->client)->id,
                'price' => number_format($indebtednes, 1),
                'remaining' => number_format($indebtednes - $paid, 1),
                'paid' => number_format($paid, 1),
                'is_case_action' => $this->is_case_action,
                'details' => $this->note,
                'completed_at' => $this->completed_at ? date('d-m-Y', strtotime($this->completed_at)) : null,
                'created_at' => date('d-m-Y', strtotime($this->created_at)),
                'options' => view('indebtednes::dashboard.indebtednes.components.table-options', ['model' => $this])->render(),
            ];
        }

    }
}
