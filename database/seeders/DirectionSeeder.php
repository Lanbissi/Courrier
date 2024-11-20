<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("directions")->insert([
             ["code_direction" => "ASI"],
             ["code_direction" => "DRH"],
             ["code_direction" => "SC"],
             ["code_direction" => "SA"],

             ["lib_direction" => "Administration Service Informatique"],
             ["lib_direction" => "Direction Ressources Humaines"],
             ["lib_direction" => "Service Comptabilité"],
             ["lib_direction" => "Secrétariat Administratif"]
        ]);

    }
}
