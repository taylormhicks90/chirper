<?php

namespace Database\Seeders;

use App\Models\ChirpLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();

        foreach($users as $user) {
            ChirpLike::create([
               'chirp_id' => 3,
               'user_id' => $user->id
            ]);
        }
    }
}
