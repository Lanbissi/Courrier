<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnotationArriveesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotation_arrivees', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateAnnotation');
            $table->date('dateSuivi');
            $table->string('numero');
            $table->longText('objet');
            $table->dateTime('dateFinTraitementTheorique');
            //$table->date('dateFinTraitementReel');
            $table->string('delaiTheorique')->nullable();
           // $table->string('delaiReel');
            $table->string("courrier_arrive_id")->constrained();
            $table->foreignId("user_id")->constrained();
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
        Schema::table('annotation_arrivees', function(Blueprint $table){
            $table->dropForeign(["user_id","courrier_arrive_id"]);
        });
        Schema::dropIfExists('annotation_arrivees');
    }
}
