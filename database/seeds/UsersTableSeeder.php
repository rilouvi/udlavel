<?php

use Illuminate\Database\Seeder;

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

        // generate 3 user author
        DB::table('users')->insert([
            [
                'name'=>"Rio Coba0",
                'email'=>"riocoba0@gmail.com",
                'password'=>bcrypt('riocoba0')
            ],
            [
                'name'=>"Rio Coba21",
                'email'=>"riocoba21@gmail.com",
                'password'=>bcrypt('riocoba21')
            ],
            [
                'name'=>"Rio Coba5",
                'email'=>"riocoba5@gmail.com",
                'password'=>bcrypt('riocoba5')
            ],
        ]);
    }
}
