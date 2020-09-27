<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'content' => $this->content,
            'parent' => $this->parent,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
            'rank' => $this->rank,
            'created_at' => $this->created_at,
            'tags' => TagsResource::collection($this->tags),
        ];
    }
}
