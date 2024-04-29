<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('accept.json')
    ->group(function () {
        Route::any('/', [ApiController::class, 'status'])->name('status');
    });
