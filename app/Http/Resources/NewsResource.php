<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
        'details' => $this->details,
        'publish_date' => $this->created_at->format('Y-m-d'),
        'photo' => $this->getFirstMediaUrl('image_news'),
        'writer'=> new UserResource($this->user)
    ];
    }
}
