<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('my_mots', function (Blueprint $table) {
            $table->id();
            $table->string("mot")->unique();
            $table->integer("longueur");
            $table->string("difficulté",50);
            $table->timestamps();
            //je peux aussi mettre la ligne :
            //$table->enum("difficulté",["facile","intermédiaire",ect...]);
            // pour accepter seulement ces valeurs là 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_mots');
    }
};
