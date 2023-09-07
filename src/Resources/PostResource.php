<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use MrVaco\NovaGallery\Resources\GalleryResource;

/** @mixin \MrVaco\NovaBlog\Models\Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title'        => $this->title,
            'slug'         => $this->slug,
            'keywords'     => $this->keywords,
            'tags'         => $this->tags,
            'introductory' => $this->introductory,
            'content'      => $this->content,
            'image'        => $this->image,
            'creator'      => $this->creator?->name,
            'updator'      => $this->updator?->name,
            'published_at' => $this->published_at,
            'gallery'      => GalleryResource::make($this->gallery) ?? null,
            'category'     => CategoryResource::make($this->whenLoaded('category')),
            'statistics'   => StatisticsResource::make($this->statistic),
        ];
    }
}
