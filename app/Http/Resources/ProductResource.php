<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'company_id' => $this->company_id,
            'description' => $this->description,
            'how_to_use' => $this->how_to_use,
            'image' => $this->image,
            'hover_image' => $this->hover_image,
            'cost_price' => $this->cost_price,
            'full_price' => $this->full_price,
            'website_price' => $this->website_price,
            'discount' => $this->discount,
            'is_new' => $this->is_new,
            'is_sail' => $this->is_sail,
            'in_home' => $this->in_home,
            'is_active' => $this->is_active,
        ];
    }
}
