<?php

namespace App\Http\Controllers\Api\Actions;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Articles\ArticleResource;
use App\Http\Resources\Articles\ArticlesCollection;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends ApiController
{

    /**
     * All Articles list
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $news = Article::query()
            ->cursorPaginate()
            ->withQueryString();

        return $this->success(new ArticlesCollection($news));
    }

    /**
     * Show an Article
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function show(Article $article): JsonResponse
    {
        return $this->success([
            'article' => new ArticleResource($article)
        ]);
    }
}
