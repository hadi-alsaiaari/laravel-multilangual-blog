<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;
class CategoryResource extends JsonResource
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
            'create' => $this->created_at->format("Y-M-d"),
            "children" => CategoryResource::collection($this->whenLoaded('children')),
            "posts" => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
