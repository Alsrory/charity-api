<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  return [
        'id' => $this->id,
       'user_id'=> $this->subscriber_id,
        'amount' => $this->amount,
        'note' => $this->note,
        'paid_method' => $this->paid_method,
        
        'paid_at' => $this->paid_at,
       'users'=>UserResource::collection($this->contributions)
       
    ];
    }
}
