<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArriveTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrive_type', function (Blueprint $table) {
            $table->foreignId("annotation_arrivee_id")->constrained();
            $table->foreignId("type_annotation_id")->constrained();
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
        Schema::table('arrive_type', function(Blueprint $table){
            $table->dropForeign(["annotation_arrivee_id", "type_annotation_id"]);
        });
        Schema::dropIfExists('arrive_type');
    }
}
