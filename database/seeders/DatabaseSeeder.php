<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   /* Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts'); */
        /* \App\Models\Post::factory(50)->create(); */
        /* \App\Models\Capitulo::factory(12)->create();
        \App\Models\Curso::factory(50)->create(); */
        /* \App\Models\Colegiado::factory(30)->create(); */
        /* \App\Models\User::factory(1)->create(); */

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class
        ]);
    }
}
