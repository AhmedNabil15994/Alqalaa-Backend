<?php

namespace Modules\Catalog\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
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
           'title'         => $this->title,
           'color'        => "<span class=\"badge badge-success\" style=\"background-color:$this->color\">$this->color</span>",
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
