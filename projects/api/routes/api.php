<?php

use App\Http\Controllers\Api\Actions\NewsController;
use App\Http\Controllers\Api\Actions\RequestsController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiMiddleware::class)
    ->prefix('v1')
    ->group(function () {
        Route::prefix('news')
            ->name('news.')
            ->group(function () {
                Route::get('', [NewsController::class, 'index'])->name('index');
                Route::post('', [NewsController::class, 'store'])->name('store');
                Route::get('{news}', [NewsController::class, 'show'])->name('show');
                Route::put('{news}', [NewsController::class, 'update'])->name('update');
                Route::delete('{news}', [NewsController::class, 'delete'])->name('hide');
                Route::delete('{news}/force', [NewsController::class, 'forceDelete'])->name('destroy');
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
