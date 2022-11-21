<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chirp;
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

         User::factory()->create([
             'name' => 'Taylor',
             'email' => 'taylor@mailinator.com',
         ]);
        User::factory()->create([
            'name' => 'Jesse',
            'email' => 'jesse@reviewmaximizer.nl',
        ]);

         User::factory(10)->create();

         for($count = 0; $count < 100; $count++ ){
             $chirp = Chirp::factory()->for(User::inRandomOrder()->first())->create();
             for($likeCount = 0; $likeCount < mt_rand(0,5); $likeCount++){
                 $chirp->like(User::inRandomOrder()->first()->id);
             }
         }

    }
}
