<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\News\StoreNewsFormRequest;
use App\Http\Requests\News\UpdateNewsFormRequest;
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
        $news = News::query()
            ->cursorPaginate()
            ->withQueryString();

        return $this->success(NewsResource::collection($news));
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
            'article' => new NewsResource($news)
        ]);
    }
}
