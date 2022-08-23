<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name'=>'sarmila','email'=>'sarmila@gmail.com','password'=>'12345678'],
            ['name'=>'sanjoy','email'=>'sanjoy@gmail.com','password'=>'12345678'],
            ['name'=>'shawon','email'=>'shawon@gmail.com','password'=>'12345678'],
        ];
        User::insert($users);
    }
}
