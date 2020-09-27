<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'categories' => new CategoriesResource($this->categories),
            'author' => new AuthorResource($this->author),
            'is_active' => $this->is_active,
            'rank' => $this->rank,
            'tags' => TagsResource::collection($this->tags),
            'publish_date' => $this->created_at,
        ];
    }
}
