<?php

namespace App\Http\Controllers;

use App\Models\wall_of_fame;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\MyUser;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class MyUserController extends Controller
{
    public function getRanking(){
        $top10Rank = wall_of_fame::with("user")
            ->orderByDesc("score")
            ->limit(20)
            ->get()
            ->map(function($entry){
                return [
                    "pseudo" => $entry->user->pseudo ?? "Inconnu",
                    "score" => $entry->score,
                ];
            });
        return response()->json($top10Rank);
    }
    public function updateScoreUser(Request $request){
        $validatedFields = $request->validate([
            'scoreToAdd' => "required",
        ]);
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Utilisateur non trouvé'], 404);
            }
            $userScore = wall_of_fame::where('user_id', $user->id)->first();
            $userScore->score += $validatedFields["scoreToAdd"];
            $userScore->save();
            return response()->json([
                "pseudo" => "Score mis à jour",
                "newScore" => $userScore->score
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Error server'], 500);
        }
    }
}
