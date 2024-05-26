<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // $faker = Faker::create();

        // // Sample interests data
        // $interests = ['metal','plastic','cardbourd','glass'];

        // // Iterate over users and assign random interests
        // foreach (User::all() as $user) {
            
        //     $user->interests = $faker->randomElements($interests, $faker->numberBetween(1, count($interests)));
        //     $user->save();
        // }
    }
}
