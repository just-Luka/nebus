<?php

use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\OrganisationController;
use App\Http\Middleware\InternalAPI;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {
    Route::get('/organisations', [OrganisationController::class, 'index']);
    Route::get('/organisations/{id}', [OrganisationController::class, 'show']);

    Route::get('/operations', [OperationController::class, 'index']);
})->middleware(InternalAPI::class);
