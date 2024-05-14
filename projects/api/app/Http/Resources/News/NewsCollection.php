<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\CursorPaginator;

/**
 * @mixin CursorPaginator
 */
class NewsCollection extends ResourceCollection
{
    public $collects = NewsResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'news' => $this->collection,
            'pagination' => [
                'next' => $this->nextPageUrl(),
                'prev' => $this->previousPageUrl(),
                'total' => $this->count()
            ]
        ];
    }
}
