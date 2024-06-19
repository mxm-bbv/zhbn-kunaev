<?php

namespace App\Http\Resources\Articles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\CursorPaginator;

/**
 * @mixin CursorPaginator
 */
class ArticlesCollection extends ResourceCollection
{
    public $collects = ArticleResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'articles' => $this->collection,
            'pagination' => [
                'next' => $this->nextPageUrl(),
                'prev' => $this->previousPageUrl(),
                'total' => $this->count()
            ]
        ];
    }
}
