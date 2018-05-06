<?php

use Illuminate\Database\Seeder;
use App\Author;
use Faker\Factory as Faker;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i<4;$i++){
            $faker = Faker::create();
            $aut = new Author;
            $aut->name = $faker->name();
            $aut->biography = $faker->sentence(rand(20,32));
            $aut->save();
        }
    }
}
