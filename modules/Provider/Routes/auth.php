<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

use Modules\Provider\Http\Controllers\Auth\LoginController;
use Modules\Provider\Http\Controllers\Front\LocationController;

Route::group(['prefix' => 'provider','as' => 'provider.'], function () {
    Route::middleware(['guest:provide'])->group(function () {
        Route::get('login', [LoginController::class, 'show'])->name('login.show');
        Route::post('login', [LoginController::class, 'login'])->name('login');
    });

    Route::middleware(['auth:provide'])->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});






// front end provider


Route::group(['prefix' => '/provider', 'middleware' => 'auth:provide'], function(){

    // other routes
    Route::group(['prefix' => '/locations', 'as' => 'provider.','namespace'=>'Front'], function(){

        //the grouped operations (declare them before resource routes to avoid conflicts)
        Route::delete('delete-many', [LocationController::class, 'destroyMany'])
        ->name('location.destroy.many');

        Route::get('ajax/datatable', LocationDataTableController::class)
            ->name('location.datatable');

        //Model Resources routes
        //didn't use resource to have the ability to attach permission middleware to each route
        // avoid using middlewares inside of controllers keep this structure maintained
        Route::get('/',[LocationController::class, 'index'])
            ->name('location.index');
        
        Route::post('/',[LocationController::class, 'store'])
            ->name('location.store');

        Route::get('create',[LocationController::class, 'create'])
            ->name('location.create');

        Route::put('{location}',[LocationController::class, 'update'])
            ->name('location.update');

        Route::get('{location}/edit',[LocationController::class, 'edit'])
            ->name('location.edit');

        Route::delete('{location}',[LocationController::class, 'destroy'])
            ->name('location.destroy');


       
    });
});

