<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InitiativeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  return [
       'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'current_amount' => $this->current_amount,
        'target_amount' => $this->target_amount,
        'status' => $this->status,
        'start_date' => $this->start_date,
        'end_date' => $this->end_date,
        'created_at' => $this->created_at,
        'photo_url' => $this->getFirstMediaUrl('image_initaitive'),
        
    ];
    }
}
