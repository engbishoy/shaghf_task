
<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth routes

use Modules\Provider\Entities\Provider;

require __DIR__.'/auth.php';

// backend 

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:dashboard'], function(){

    // other routes
    Route::group(['prefix' => 'providers', 'as' => 'provider.'], function(){

        //the grouped operations (declare them before resource routes to avoid conflicts)
        Route::delete('delete-many', [Modules\Provider\Http\Controllers\ProviderController::class, 'destroyMany'])
        ->name('destroy.many');

        Route::get('ajax/datatable', ProviderDatatableController::class)
            ->name('datatable');

        //Model Resources routes
        //didn't use resource to have the ability to attach permission middleware to each route
        // avoid using middlewares inside of controllers keep this structure maintained
        Route::get('/',[Modules\Provider\Http\Controllers\ProviderController::class, 'index'])
            ->name('index');
        
        Route::post('/',[Modules\Provider\Http\Controllers\ProviderController::class, 'store'])
            ->name('store');

        Route::get('create',[Modules\Provider\Http\Controllers\ProviderController::class, 'create'])
            ->name('create');

        Route::put('{provider}',[Modules\Provider\Http\Controllers\ProviderController::class, 'update'])
            ->name('update');

        Route::get('{provider}/edit',[Modules\Provider\Http\Controllers\ProviderController::class, 'edit'])
            ->name('edit');

        Route::delete('{provider}',[Modules\Provider\Http\Controllers\ProviderController::class, 'destroy'])
            ->name('destroy');


        // trashed routes
        Route::group(['prefix' => 'trashed', 'as' => 'trashed.', 'namespace' => 'Trashed'], function(){
            //the grouped operations (declare them before resource routes to avoid conflicts)
            Route::delete('/delete-many', [Modules\Provider\Http\Controllers\Trashed\ProviderTrashedController::class, 'destroyMany'])
                ->name('destroy.many');

            Route::post('/restore-many', [Modules\Provider\Http\Controllers\Trashed\ProviderTrashedController::class, 'restoreMany'])
                ->name('restore.many');

            // trashed resource operation
            Route::delete('/{provider}', [Modules\Provider\Http\Controllers\Trashed\ProviderTrashedController::class, 'destroy'])
                ->name('destroy');

            Route::post('/{provider}', [Modules\Provider\Http\Controllers\Trashed\ProviderTrashedController::class, 'restore'])
                ->name('restore');

            Route::get('/ajax/datatable', ProviderTrashedDataTableController::class)
                ->name('datatable');
        });
    });
});




// locations provider by user_name
Route::domain('{user_name}.localhost')->group(function () {
    route::get('/',function($user_name){
        $provider=Provider::where('user_name',$user_name)->first();
        return view('provider::locations_username',compact('provider'));
    });
    
});
