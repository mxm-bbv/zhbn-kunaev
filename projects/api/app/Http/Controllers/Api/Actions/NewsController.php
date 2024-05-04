<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\News\StoreNewsFormRequest;
use App\Http\Requests\News\UpdateNewsFormRequest;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class NewsController extends ApiController
{

    /**
     * All News list
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(
            new NewsCollection(
                News::query()
                    ->cursorPaginate()
                    ->withQueryString()
            )
        );
    }

    /**
     * Show an Article
     *
     * @param  News  $news
     * @return JsonResponse
     */
    public function show(News $news): JsonResponse
    {
        return $this->success([
            'news' => new NewsResource($news)
        ]);
    }

    /**
     * Create an Article
     *
     * @param StoreNewsFormRequest $request
     * @return JsonResponse
     */
    public function store(StoreNewsFormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->success(data: [
            'news' => new NewsResource(News::create($validatedData))
        ], code: 201);
    }

    /**
     * Update an Article
     *
     * @param UpdateNewsFormRequest $request
     * @param News $news
     * @return JsonResponse
     */
    public function update(UpdateNewsFormRequest $request, News $news): JsonResponse
    {
        $validatedData = $request->validated();
        $news->update($validatedData);

        return $this->success(new NewsResource($news));
    }

    /**
     * Hide an Article
     *
     * @param News $news
     * @return JsonResponse
     */
    public function delete(News $news): JsonResponse
    {
        return $this->success(data: [
            'success' => $news->delete()
        ], code: 204);
    }

    /**
     * Delete an Article
     *
     * @param News $news
     * @return JsonResponse
     */
    public function forceDelete(News $news): JsonResponse
    {
        return $this->success(data: [
            'success' => $news->forceDelete()
        ], code: 204);
    }
}
