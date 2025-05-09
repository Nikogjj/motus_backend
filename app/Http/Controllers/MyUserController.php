<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\MyUser;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MyUserController extends Controller
{
    public function createUser(Request $request){
        // //attend un form avec pseudo password et numero_secu !!
        $validatedFields = $request->validate([
            'pseudo'=>"required|string",
            'password'=>"required|string",
        ]);

        $userInfo = $request->json()->all();

        $existing = MyUser::where('pseudo', $request->pseudo)->first();
        if(!$existing){
            $userCreated = MyUser::create([
                "pseudo"=>$request->pseudo,
                "password"=>Hash::make($request->password),
                "numero_secu"=>$request->numero_secu
            ]);
            return response([
                "message"=>"Compte créer avec succès",
                "description"=>[
                    "id"=>$userCreated->id,
                    "pseudo"=>$userCreated->pseudo
                ],
                "error" => "none"
            ]);
        }else{
            return response([
                "message"=>"Identifiant non disponible",
                "description"=>"none",
                "error" => "Identifiant non disponible"
            ]);
        }
    }

    public function deleteAllUsers(Request $request){
        DB::table("my_users")->delete();
        return response()->json([
            "message"=>"tous les mots on été supprimés avec succès"
        ]);
    }

    public function loginUser(Request $request){
        //voir avec massi pour avoir comment faire mon login
        $request->validate([
        ]);
    }
}
