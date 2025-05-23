<?php

namespace Modules\Apps\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PrintReportsRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'path'         => $this->file_path,
           'status'        => $this->status,
           'created_at'    => Carbon::parse($this->created_at)->toDateTimeString(),
       ];
    }
}
