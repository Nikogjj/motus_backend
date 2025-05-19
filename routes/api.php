<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\MyMotController;

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);
Route::get("get_random_mot",[MyMotController::class,"selectRandomMot"]);


Route::middleware("jwt")->group(function () {
    Route::post("update_score_user",[MyUserController::class,"updateScoreUser"]);
    Route::get("get_infos_user",[AuthController::class,"getUser"]);
    Route::post("get_random_mot_by_difficulte",[MyMotController::class,"selectRandomMotByDifficulte"]);
    Route::post("get_ranking",[MyUserController::class,"getRanking"]);
    Route::post("logout",[AuthController::class,"logout"]);
});