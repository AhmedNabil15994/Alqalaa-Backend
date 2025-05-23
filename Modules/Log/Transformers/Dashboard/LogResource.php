<?php

namespace Modules\Log\Transformers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
            'title' => $this->action_description,
            'user' => (object)['id' => optional($this->causer)->id, 'name' => optional($this->causer)->name],
            'model' => optional($this->subject)->id,
            'model_name' => $this->model_name,
            'description' => __('log::dashboard.logs.activities.actions.' . $this->description),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
