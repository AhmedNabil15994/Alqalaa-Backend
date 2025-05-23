<?php

namespace Modules\User\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $active_title = __('apps::dashboard.datatable.unactive');
        $not_active_title = __('apps::dashboard.datatable.active');
        $labels = '';
        foreach($this->labels as $label){
            $labels .= "$label->label_title<br>";
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'national_ID' => $this->national_ID,
            'phone' => optional($this->phones()->first())->phone,
            'status' => ajaxSwitch($this, url(route('dashboard.clients.switch', [$this->id, 'status']))),
            'state_id' => optional(optional($this->address)->state)->title,
            'is_judging' => $this->is_judging,
            'status_title' => $this->status ? $active_title: $not_active_title,
            'is_judging_title' => $this->is_judging ? $active_title: $not_active_title,
            'profit' => $this->profit,
            'labels' => $labels,
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'options' => view('user::dashboard.clients.components.table-options', ['model' => $this])->render(),
        ];
    }
}
