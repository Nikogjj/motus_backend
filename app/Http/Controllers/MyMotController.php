<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Http\Request;
use App\Models\MyMot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MyMotController extends Controller
{
    public function createMots(Request $request) {
        $request->validate([
            'mot*.mot' => 'required|string',
            '*.longueur' => 'required|integer',
            '*.difficulté' => 'required'
        ]);
        $data = $request->json()->all();
        $createdMots = [];
    
        DB::transaction(function() use ($data, &$createdMots) {

            foreach ($data as $mot) {
                $existing = MyMot::where('mot', $mot['mot'])->first();
                if(!$existing){
                    $motCreated = MyMot::create([
                        "mot" => $mot['mot'],
                        "longueur" => $mot['longueur'],
                        "difficulté" => $mot['difficulté']
                    ]);
                    $createdMots[] = [
                        'id' => $motCreated->id,
                        'mot' => $motCreated->mot
                    ];
                }
            }
        });
        
        return response()->json([
            "message" => "Mots créés avec succès",
            "mots" => $createdMots
        ]);
    }

    public function deleteAllMots(Request $request){
        DB::table("my_mots")->delete();
        return response()->json([
            "message"=>"tous les mots on été supprimés avec succès"
        ]);
    }

    public function selectRandomMot(){
        // $validated = $request->validate([
        //     "longueur"=>"required|string",
        // ]);
        $randomInt = random_int(5,9);
        $element = MyMot::where("longueur",$randomInt)->inRandomOrder()->first();
        // return response()->json([$element]);
        return response()->json([
            "mot"=> $element["mot"],
            "longueur"=> $element["longueur"],
            "difficulte"=> $element["difficulté"]
        ]);
    }

    public function selectRandomMotByDifficulte(Request $request){
        try {
            $validated = $request->validate([
                "difficulte"=>"required|string",
            ]);
            $element = MyMot::where("difficulté",$validated["difficulte"])->inRandomOrder()->first();
            $randomMot = [
                "mot"=> $element["mot"],
                "difficulte"=>$element["difficulté"],
                "longueur"=> $element["longueur"]
            ];
        } catch (\Throwable $th) {
            $randomMot = [
                "error" => "error"
            ];
        }finally{
            return response()->json(data: $randomMot);
        }
    }
}
