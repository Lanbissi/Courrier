<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
             ["nom"=>"Superadmin"],
             ["nom"=>"Admin"],
             ["nom"=>"Directeur"],
             ["nom"=>"Employé(Secrétaire)"],
             ["nom"=>"Employé(Autres)"],
        ]);
    }
}
