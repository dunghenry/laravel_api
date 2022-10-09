<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->where('id', '[0-9]+');

// Route::resource('/customers', App\Http\Controllers\CustomerController::class)->only(['index', 'show', 'store', 'destroy', 'update']);

Route::resource('/customers', App\Http\Controllers\CustomerController::class)->except(['create', 'edit']);

// Route::resource('v1/customers', App\Http\Controllers\Api\v1\CustomerController::class);

Route::prefix('v1')->group(function () {
    Route::resource('customers', App\Http\Controllers\Api\v1\CustomerController::class);
});
Route::prefix('v2')->group(function () {
    Route::resource('customers', App\Http\Controllers\Api\v2\CustomerController::class);
});
