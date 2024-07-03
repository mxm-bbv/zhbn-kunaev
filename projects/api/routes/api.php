<?php

use App\Http\Controllers\Api\Actions\ArticleController;
use App\Http\Controllers\Api\Actions\RequestsController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiMiddleware::class)
    ->prefix('v1')
    ->name('api.')
    ->group(function () {
        Route::prefix('articles')
            ->name('articles.')
            ->group(function () {
                Route::get('', [ArticleController::class, 'index'])->name('index');
                Route::post('', [ArticleController::class, 'store'])->name('store');
                Route::get('{article}', [ArticleController::class, 'show'])->name('show');
                Route::put('{article}', [ArticleController::class, 'update'])->name('update');
                Route::delete('{article}', [ArticleController::class, 'delete'])->name('hide');
                Route::delete('{article}/force', [ArticleController::class, 'forceDelete'])->name('destroy');
            });
        Route::prefix('requests')
            ->name('requests.')
            ->group(function () {
                Route::get('', [RequestsController::class, 'index'])->name('index');
                Route::post('', [RequestsController::class, 'store'])->name('store');
                Route::get('{request}', [RequestsController::class, 'show'])->name('show');
                Route::put('{request}', [RequestsController::class, 'update'])->name('update');
                Route::delete('{request}', [RequestsController::class, 'delete'])->name('hide');
                Route::delete('{request}/force', [RequestsController::class, 'forceDelete'])->name('destroy');
            });
    });
