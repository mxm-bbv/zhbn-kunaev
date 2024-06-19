<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Requests\StoreRequestFormRequest;
use App\Http\Resources\Requests\RequestsResource;
use App\Models\Requests;
use Illuminate\Http\JsonResponse;

class RequestsController extends ApiController
{
    public function store(StoreRequestFormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->success(data: [
            'requests' => new RequestsResource(Requests::create($validatedData))
        ], code: 201);
    }
}
