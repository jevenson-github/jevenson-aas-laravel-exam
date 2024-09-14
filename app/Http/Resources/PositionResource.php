<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    // Allows us to transform our eloquent model and return into JSON response with ease . 
    public function toArray(Request $request): array
    {
            
        return [
            'id' => $this->id,
            'position_name' => $this->position_name,
            'reports_to' => $this->reports_to?->position_name ?? '',  //  ' ? ' Means what will display if conditions is not satisfied 
            'reports_to_id' => $this->reports_to_id
        ];
    }
}
