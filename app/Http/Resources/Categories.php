<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categories extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [

            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'category_name' => $this->category_name,
            'category_url' => $this->category_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => $this->products

        ];
    }
}
