<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Samuel';
        $user->email = 'samuel@gmail.com';
        $user->password ='password';
        $user->save();
        $user->roles()->attach([1, 2]);

        $user = new User();
        $user->name = 'Demo';
        $user->email = 'demo@gmail.com';
        $user->password ='password';
        $user->save();
        $user->roles()->attach([2]);

        $user = new User();
        $user->name = 'Demo2';
        $user->email = 'demo2@gmail.com';
        $user->password ='password';
        $user->save();
        $user->roles()->attach([3]);
    }
}
