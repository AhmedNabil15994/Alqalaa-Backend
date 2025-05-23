<?php

namespace Modules\Contract\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthPercentageResource extends JsonResource
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

        return [
            'id' => $this->id,
            'month_number' => $this->month_number,
            'presentage' => $this->presentage,
            'status_title' => $this->status ? $active_title: $not_active_title,
            'status' => ajaxSwitch($this, url(route('dashboard.month-percentages.switch', [$this->id, 'status']))),
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
