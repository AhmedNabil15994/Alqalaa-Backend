<?php

namespace Modules\Installment\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class InstallmentPaymentExcelExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {      
        if($this->pay_by_type == 'by_link'){

            $clientName = ((array)json_decode($this->client_name));
            $output = '';

            if(isset($clientName['en'])){
                $output = "EN: {$clientName['en']}";
            }

            if(isset($clientName['ar'])){
                $output = "AR: {$clientName['ar']}";
            }

            $clientName = $output;

        } elseif($this->pay_by_type == 'by_admin'){
            $clientName = $this->admin_name;
        }else{
            $clientName = '';
        }

        if($this->pay_by_type != ''){
            $pay_by_type =  __("installment::dashboard.installments.btn.{$this->pay_by_type}");
        }else{
            $pay_by_type = '';
        }
        
        return [
            'id' => $this->id,
            'installment_id' => $this->installment_id,
            'paid_amount' => $this->paid_amount,
            'transaction_date' => $this->transaction_date,
            'pay_by_type' => $pay_by_type,
            'client_name' => $clientName,
            'note' => $this->note,
        ];
    }
}
