<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourrierArrivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courrier_arrives', function (Blueprint $table) {
            $table->id();
            $table->integer('numPrimaire')->nullable();
            $table->string('reference')->nullable();
            $table->integer('numEnregistrement')->nullable();
            $table->longText('objet')->nullable();
            $table->string('structure')->nullable();
            $table->string('referencePJ')->nullable();
            $table->string('priorite')->nullable();
            $table->string('nomExpediteur')->nullable();
            $table->string('destinataire')->nullable();
            $table->dateTime('dateArrive')->nullable();
            $table->dateTime('dateDepart')->nullable();
            $table->string('numReponse')->nullable();
            $table->string('observation')->nullable();
            $table->dateTime('dateReponse')->nullable();
            $table->dateTime('dateSaisi')->nullable();
            $table->string('email')->nullable();
            $table->integer('nombrePiece')->nullable();
            $table->boolean('estEnvoyer')->default(0);
            $table->string('courrierNumerise')->nullable();
            $table->foreignId("chrono_id")->constrained()->nullable();
            $table->foreignId("nature_courrier_arrive_id")->constrained()->nullable(); 
            $table->string('categorie')->nullable();
            //$table->foreignId("file_courrier_arrive_id")->constrained(); 
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
        Schema::table('courrier_arrives', function(Blueprint $table){
            $table->dropForeign(["chrono_id", "nature_courrier_arrive_id"]);
        });
        Schema::dropIfExists('courrier_arrives');
    }
}
