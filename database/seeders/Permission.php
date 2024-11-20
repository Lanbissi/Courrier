<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["nom"=>"Ajouter un utilisateur"],
            ["nom"=>"Consulter la liste utilisateur"],
            ["nom"=>"Editer un utilisateur"],

            ["nom"=>"Ajouter une numerotation"],
            ["nom"=>"Consulter une numerotation"],
            ["nom"=>"Editer une numerotation"],

            ["nom"=>"Ajouter un courrier arrive"],
            ["nom"=>"Consulter courrier arrive"],
            ["nom"=>"Editer un courrier arrive"]
       ]);
    }
}
