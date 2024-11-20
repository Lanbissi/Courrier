<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourrierArriveFonctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courrier_arrive_fonction', function (Blueprint $table) {
            $table->foreignId("courrier_arrive_id")->constrained();
            $table->foreignId("fonction_id")->constrained();
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
        Schema::table('courrier_arrive_fonction', function(Blueprint $table){
            $table->dropForeign(["courrier_arrive_id", "fonction_id"]);
        });
        Schema::dropIfExists('courrier_arrive_fonction');
    }
}
