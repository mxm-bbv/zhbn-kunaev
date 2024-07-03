<?php

namespace App\Http\Resources\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $media = $this->getMedia("news-media")
            ->map(fn($media) => [
                'name' => $media['name'],
                'url' => $media['original_url'],
            ]);

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'views' => $this->views,
            'status' => $this->status,
            'thumb' => $media->first(),
            'media' => $media,
            'date' => $this->created_at->format('d.m.Y'),
        ];
    }
}
