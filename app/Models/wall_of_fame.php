<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wall_of_fame extends Model
{
    protected $table = "wall_of_fame";
    protected $fillable = ["user_id","score"];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
