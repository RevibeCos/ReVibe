<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company_id' => $this->company->name,
            'description' => $this->description,
            'how_to_use' => $this->how_to_use,
            'image' => $this->image,
            'hover_image' => $this->hover_image,
            'full_price' => $this->full_price,
            'website_price' => $this->website_price,
            'discount' => $this->discount,
            'is_new' => $this->is_new,
            'is_sail' => $this->is_sail,
            'rates'=>$this->rates,
            'attributes'=>$this->attributes,



        ];
    }
}
