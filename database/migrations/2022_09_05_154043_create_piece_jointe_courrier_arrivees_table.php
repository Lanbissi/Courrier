<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePieceJointeCourrierArriveesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_jointe_courrier_arrivees', function (Blueprint $table) {
            $table->id();
            $table->string('pjNumerise');
            $table->timestamps();
            $table->foreignId("courrier_arrive_id")->constrained();
        });

        Schema::enableForeignKeyConstraints(); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('piece_jointe_courrier_arrivees', function(Blueprint $table){
            $table->dropForeign(["courrier_arrive_id"]);
        });
        Schema::dropIfExists('piece_jointe_courrier_arrivees');
    }
}
