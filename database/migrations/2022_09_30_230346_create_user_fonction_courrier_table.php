<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFonctionCourrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fonction_courrier', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained();
            $table->foreignId("fonction_id")->constrained();
            $table->dateTime('dateFinReel')->nullable();
            $table->integer('delaiReel')->nullable();
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
        Schema::table('user_fonction_courrier', function(Blueprint $table){
            $table->dropForeign(["user_id", "fonction_id"]);
        });
        Schema::dropIfExists('user_fonction_courrier');
    }
}
