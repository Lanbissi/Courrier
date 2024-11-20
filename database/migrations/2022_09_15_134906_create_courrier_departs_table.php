<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourrierDepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courrier_departs', function (Blueprint $table) {
            $table->id();
            $table->integer('numOrdre')->unique();
            $table->integer('nombrePiece');
            $table->date('dateDepart');
            $table->string('destinataire');
            $table->longText('objet');
            $table->longText('observation')->nullable();   
            $table->foreignId("chrono_id")->constrained();
            $table->string('categorie');
            $table->timestamps();
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
        Schema::table('courrier_departs', function(Blueprint $table){
            $table->dropForeign(["chrono_id"]);
        });
        Schema::dropIfExists('courrier_departs');
    }
}
