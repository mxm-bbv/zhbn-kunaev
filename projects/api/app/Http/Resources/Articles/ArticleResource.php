<?php

namespace App\Http\Resources\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Article
 */
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
            'description' => $this->description,
            'views' => $this->views,
            'status' => $this->status,
            'media' => $this->getMedia("news-media")
                ->map(fn($media) => [
                    'name' => $media['name'],
                    'url' => $media['original_url'],
                ])
        ];
    }
}
