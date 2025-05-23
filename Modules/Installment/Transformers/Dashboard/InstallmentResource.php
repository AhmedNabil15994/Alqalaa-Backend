<?php

namespace Modules\Installment\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contract\Transformers\Dashboard\LiteContractResource;

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
            'client_name' => optional(optional($this->contract)->client)->name,
            'phone' => optional(optional(optional($this->contract)->client)->phone)->phone,
            'contract' => new LiteContractResource($this->contract),
            'amount' => $this->amount,
            'valid_to_pay' => $this->valid_to_pay,
            'remaining' => $this->remaining,
            'paid' => $this->paid,
            'offer_percentage' => $this->offerPercentage($this->offer_percentage),
            'due_date' => $this->due_date,
            'transaction_date' => $this->transaction_date,
            'note' => $this->note,
            'status' => $this->buildStatusView($this->status),
            'status_check' => $this->status,
            'status_title' => __('installment::dashboard.installments.datatable.'.$this->status),
            'payments' => InstallmentPaymentResource::collection($this->payments),
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }

    function buildStatusView($status) {
        switch ($status) {
            case 'not_complete':
                return ' <label class="label label-warning">'.__('installment::dashboard.installments.datatable.not_complete').'</label>';
            case 'completed':
                return ' <label class="label label-success">'.__('installment::dashboard.installments.datatable.completed').'</label>';
            case 'waiting':
                return ' <label class="label label-danger">'.__('installment::dashboard.installments.datatable.waiting').'</label>';
        }
    }

    function offerPercentage($offerPercentage) {
        return $offerPercentage ? "<span class=\"badge badge-primary\"> {$offerPercentage} %</span>" :
        ' <label class="label label-danger">'.__('installment::dashboard.installments.datatable.nothasoffer').'</label>';
    }
}
