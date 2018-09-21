<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        $faker=Factory::create();
        // generate 3 user author
        DB::table('users')->insert([
            [
                'name'=>"Rio Coba0",
                'slug'=>"rio-coba0",
                'email'=>"riocoba0@gmail.com",
                'password'=>bcrypt('riocoba0'),
                'bio'=>$faker->text(rand(250, 300))
            ],
            [
                'name'=>"Rio Coba21",
                'slug'=>"rio-coba21",
                'email'=>"riocoba21@gmail.com",
                'password'=>bcrypt('riocoba21'),
                'bio'=>$faker->text(rand(250, 300))
            ],
            [
                'name'=>"Rio Coba5",
                'slug'=>"rio-coba5",
                'email'=>"riocoba5@gmail.com",
                'password'=>bcrypt('riocoba5'),
                'bio'=>$faker->text(rand(250, 300))
            ],
        ]);
    }
}
