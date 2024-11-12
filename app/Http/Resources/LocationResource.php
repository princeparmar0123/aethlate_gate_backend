<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'owner_name' => $this->owner_name,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'gst_certifiate' => asset('images/gst/' . $this->gst_certificate),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
