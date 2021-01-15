<?php

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
        DB::table('users')->insert([
            'name' => 'admin',
            'username'=> 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);
    }
}
