<?php

namespace App\Http\Controllers\Api\Actions;

use App\Filament\Resources\ArticlesResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Articles\StoreArticleFormRequest;
use App\Http\Requests\Articles\UpdateArticleFormRequest;
use App\Http\Resources\Articles\ArticleResource;
use App\Http\Resources\Articles\ArticlesCollection;
use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            ->where('status', 'published')
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
        if ($article->status !== 'published') {
            throw new ModelNotFoundException();
        }

        $article->increment('views');

        return $this->success([
            'article' => new ArticleResource($article)
        ]);
    }
}
