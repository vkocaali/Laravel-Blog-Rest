<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tag_id' => $this->tag_id,
            'tag_name' => $this->tag_name,
            'is_active' => $this->is_active
        ];
    }
}
