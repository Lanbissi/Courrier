<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DirectionSeeder::class);
        Direction::factory(5)->create();
        Fonction::factory(5)->create();
        User::factory(5)->create();

        $this->call(Role::class);
        $this->call(Permission::class);

        //Donner un role a un utilisateur

        User::find(1)->roles()->attach(1);
        User::find(2)->roles()->attach(2);
        User::find(3)->roles()->attach(3);
        User::find(4)->roles()->attach(4);
        User::find(5)->roles()->attach(5);
    }
}
