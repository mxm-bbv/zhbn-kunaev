<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    public function updated(Article $article) {
        $article->updateQuietly([
            'slug' => Str::slug($article->title),
        ]);
    }
}
