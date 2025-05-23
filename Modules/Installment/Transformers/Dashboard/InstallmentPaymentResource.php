<?php

namespace Modules\Installment\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class InstallmentPaymentResource extends JsonResource
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
            'amount' => number_format($this->amount,3),
            'transaction_date' => $this->transaction_date,
            'note' => $this->note,
            'user_id' => optional($this->user)->id ?? null,
            'user' => optional($this->user)->name,
            'pay_by_type' => $this->pay_by_type ? __("installment::dashboard.installments.btn.{$this->pay_by_type}") 
                : __("installment::dashboard.installments.btn.un_known"),
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
