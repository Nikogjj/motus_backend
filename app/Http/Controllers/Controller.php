<?php

namespace App\Http\Controllers;

use App\Models\wall_of_fame;
use Log;
use Request;

abstract class Controller
{
    public function getRanking(){
        // $top10Rank = wall_of_fame::with("user")->orderByDesc("score")->limit(10)->get("");
        // return response()->json($top10Rank);
        Log::info("BLABLABLABALBA");
        return response()->json(["ok"]);
    }
}
