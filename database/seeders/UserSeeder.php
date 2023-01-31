<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Colegio de Ingenieros',
            'email' => 'OTSCippuno2022@gamil.com',
            'password' => bcrypt('otscippuno746')
        ])->assignRole('SuperAdmin');
        
        User::create([
            'name' => 'Colegio de Ingeneiros2',
            'email' => 'cippuno2022@gmail.com',
            'password' => bcrypt('cippunopuno22')
        ])->assignRole('Admin');
        /* User::factory(9)->create(); */
        /* User::factory(9)->create(); */
    }
}
