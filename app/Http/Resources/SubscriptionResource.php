<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {  return [
        'id' => $this->id,
    //    'subscriber_id'=> $this->subscriber_id,
        'amount' => $this->amount,
        'month' => $this->month,
        'payment_method' => $this->payment_method,
        'status' => $this->status,
        'paid_at' => $this->paid_at,
        'year'=>optional($this->created_at)->year,
        'is_paid '=> $this->status === 'paid',
        // 'subscriber'=>new SubscriberResource($this->subscriber)
       
    ];
    }
}
