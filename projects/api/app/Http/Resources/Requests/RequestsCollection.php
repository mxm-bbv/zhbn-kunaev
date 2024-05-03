<?php

namespace app\Http\Resources\Requests;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'requests' => $this->collection,
            ''
        ];
    }
}
