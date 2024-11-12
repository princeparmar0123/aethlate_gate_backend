<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'package_name' => $this->package_name,
            'price' => $this->price,
            'validity' => $this->validity,
            'description' => $this->description,
            'attribute' => $this->attribute,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
