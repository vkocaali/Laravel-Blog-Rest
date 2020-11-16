<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'text' => $this->tag_name,
        ];
    }
}
