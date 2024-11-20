<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePieceJointeAnnotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_jointe_annotations', function (Blueprint $table) {
            $table->id();
            $table->string('pjNumerise');
            $table->foreignId("annotation_arrivee_id")->constrained();
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
        Schema::table('piece_jointe_annotations', function(Blueprint $table){
            $table->dropForeign(["annotation_arrivee_id"]);
        });
        Schema::dropIfExists('piece_jointe_annotations');
    }
}
