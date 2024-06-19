<?php

use App\Http\Controllers\Api\Actions\ArticleController;
use App\Http\Controllers\Api\Actions\RequestsController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiMiddleware::class)
    ->prefix('v1')
    ->group(function () {
        Route::prefix('articles')
            ->name('articles.')
            ->group(function () {
                Route::get('', [ArticleController::class, 'index'])->name('index');
                Route::get('{article}', [ArticleController::class, 'show'])->name('show');
            });

        Route::prefix('requests')
            ->name('requests.')
            ->group(function () {
                Route::post('', [RequestsController::class, 'store'])->name('store');
            });
    });
