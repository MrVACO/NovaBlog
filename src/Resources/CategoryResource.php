<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \MrVaco\NovaBlog\Models\Category */
class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'keywords'    => $this->keywords,
            'description' => $this->description,
            'image'       => $this->image,
            'creator'     => $this->creator?->name,
            'updator'     => $this->updator?->name,
            'created_at'  => $this->created_at,
        ];
    }
}
