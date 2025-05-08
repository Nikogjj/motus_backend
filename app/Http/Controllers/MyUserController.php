<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\MyUser;
use PhpParser\Node\Expr\FuncCall;

class MyUserController extends Controller
{
    public function createUser(Request $request){
        //attend un form avec pseudo password et numero_secu !!
        $request->validate([
            "pseudo"=>"required",
            "password"=>"required",
            "numero_secu"=>"required"
        ]);

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
            ]
        ]);
    }

    public function deleteUser(){
        // 
        
    }

    public function loginUser(Request $request){
        //voir avec massi pour avoir comment faire mon login
        $request->validate([

        ]);
    }
}
