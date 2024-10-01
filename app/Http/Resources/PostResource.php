<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'image' => asset($this->image),
            'parent' => $this->parent,
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            "small_desc" => $this->small_desc,
            "blog" => $this->small_desc . ' ' . $this->content,
            'create' => $this->created_at->format("Y-M-d"),
            "writer" => $this->whenLoaded('user'),
            "category" => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
