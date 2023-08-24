<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return response()->Json([
        'sucess' => true
    ]);
});
Route::apiResource('/users', UserController::class);

// Route::delete('users/{id}', [UserController::class, 'destroy']);

// Route::patch('/users/{id}', [UserController::class, 'update']);

// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route::post('/users', [UserController::class, 'store'])->name('users.store');
