<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\MyMotController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/test',function(){
    return "salut";
});

Route::post('addUser',[MyUserController::class, "createUser"]);

Route::get('loginUser',[MyUserController::class,"loginUser"]);

Route::post('addMots',[MyMotController::class,"createMots"]);

Route::delete('deleteAllMots',[MyMotController::class,"deleteAllMots"]);