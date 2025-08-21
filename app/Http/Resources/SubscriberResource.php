<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  return [
        

        'Subscriber_Id' => $this->id,
        'status' => $this->status,
         'subscribed_at'=>$this->subscribe_at,
        'user' => new UserResource($this->user),
        'subscriptions'=>SubscriptionResource::collection($this->subscriptions),
       

    ];
    }
}
