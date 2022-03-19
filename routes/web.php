<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;





// 1 - setting
// 2 - mng accounts
/* Route::get('/bilal', function(){
    
    dd("hello");
}); */
       


Route::group(['prefix' => 'regions'], function () {
    // users list / consult
    Route::get('', [RegionController::class, 'index'])
        ->name('regions');
    // delete user
    Route::get('delete/{id}', [RegionController::class, 'delete'])
        ->name('delete.region');
    // delete selected users
    Route::post('delete-selected', [RegionController::class, 'deleteMulti'])
        ->name('delete.regions');
    // show one user
    Route::get('get/{id}', [RegionController::class, 'show'])
        ->name('show.region');
    //update user
    Route::post('update/{id}', [RegionController::class, 'update'])
        ->name('update.region');
    // add user (view)
    Route::get('create', [RegionController::class, 'create'])
        ->name('create.region');
    // add user (post)
    Route::post('store', [RegionController::class, 'store'])
        ->name('store.region');
});




Route::group(['prefix' => 'etudiants'], function () {
    // users list / consult
    Route::get('', [EtudiantController::class, 'index'])
        ->name('etudiants');
    // delete user
    Route::get('delete/{id}', [EtudiantController::class, 'delete'])
        ->name('delete.etudiant');
    // delete selected users
    Route::post('delete-selected', [EtudiantController::class, 'deleteMulti'])
        ->name('delete.etudiants');
    // show one user
    Route::get('get/{id}', [EtudiantController::class, 'show'])
        ->name('show.etudiant');
    //update user
    Route::post('update/{id}', [EtudiantController::class, 'update'])
        ->name('update.etudiant');
    // add user (view)
    Route::get('create', [EtudiantController::class, 'create'])
        ->name('create.etudiant');
    // add user (post)
    Route::post('store', [EtudiantController::class, 'store'])
        ->name('store.etudiant');
});



























































































