<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \MrVaco\NovaBlog\Models\Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'         => $this->name,
            'keywords'     => $this->keywords,
            'title'        => $this->title,
            'introductory' => $this->introductory,
            'content'      => $this->content,
            'slug'         => $this->slug,
            'image'        => $this->image,
            'creator'      => $this->creator?->name,
            'updator'      => $this->updator?->name,
            'published_at' => $this->published_at,
            'created_at'   => $this->created_at,
            
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
