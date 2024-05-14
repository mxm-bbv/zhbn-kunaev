<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Api\ApiController;
use app\Http\Requests\News\StoreNewsFormRequest;
use app\Http\Requests\News\UpdateNewsFormRequest;
use app\Http\Resources\Requests\RequestsResource;
use App\Models\Requests;
use Illuminate\Http\JsonResponse;

class RequestsController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->success(
            RequestsResource::collection(
                Requests::query()
            )
        );
    }

    public function show(Requests $requests): JsonResponse
    {
        return $this->success([
            'requests' => new RequestsResource($requests)
        ]);
    }

    public function store(StoreNewsFormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->success(data: [
            'requests' => new RequestsResource(Requests::create($validatedData))
        ], code: 201);
    }

    public function update(UpdateNewsFormRequest $request, Requests $requests): JsonResponse
    {
        $validatedData = $request->validated();
        $requests->update($validatedData);

        return $this->success(new RequestsResource($requests));
    }

    public function delete(Requests $requests): JsonResponse
    {
        return $this->success(data: [
            'success' => $requests->delete()
        ], code: 204);
    }
}
