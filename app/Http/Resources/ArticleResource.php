<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'slug' => $this->slug,
            'categories' => new CategoriesResource($this->categories),
            'author' => new AuthorResource($this->author),
            'is_active' => $this->is_active,
            'rank' => $this->rank,
            'tags' => TagsResource::collection($this->tags->where('tag_type',Article::class)),
            'image' => $this->storage,
            'favorite' => $this->favorite,
            'publish_date' => $this->created_at,
        ];
    }
}
