<?php

namespace Modules\Contract\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contract\Entities\Contract;

class ContractTypesResource extends JsonResource
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
            'title' => $this->title,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
