<?php

namespace Modules\Casee\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseActionResource extends JsonResource
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
            'client_id' => optional($this->client)->name,
            'description' => $this->description,
            'indebtednes' => $this->price,
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
