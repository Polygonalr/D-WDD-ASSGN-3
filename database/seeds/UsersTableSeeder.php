<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::all()->isEmpty()){
            $user = new User;
            $user->name = "Admin";
            $user->email = "adminuser@basslibraries.com";
            $user->password = Hash::make("TopSecret123");
            $user->save();
        }
        //need to loop here and create multiple users using Faker Factory.
        for($i=0;$i<10;$i++){
            $faker = Faker::create();
            $user = new User;
            $user->name= $faker->name;
            $user->email = $faker->freeEmail;
            $user->password = Hash::make("password");
            $user->save();
        }
    }
}
