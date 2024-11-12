<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'complex_name' => $this->complex_name,
            'user_id' => $this->user_id,
            'sport_id' => $this->sport_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Include images in the response
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' =>asset('images/complex/' . $image->url), 
                    'created_at' => $image->created_at,
                    'updated_at' => $image->updated_at,
                ];
            }),
        ];
    }
}
