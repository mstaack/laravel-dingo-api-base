<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Joe Archer',
            'email' => 'joe.archer@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
