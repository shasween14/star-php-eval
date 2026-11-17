<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'summary' => $this->summary,
            'author' => $this->author,
            'permalink' => $this->permalink,
            'published_at' => $this->published_at?->toDateTimeString(),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
