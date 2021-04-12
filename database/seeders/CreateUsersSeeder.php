<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'isUser',
                'username' => 'isUser',
                'email' => 'User@dummy.com',
                'password' => bcrypt('1234'),
                'photo' => 'image.png',
                'roles_id' => 2
            ],
            [
                'name' => 'isAdmin',
                'username' => 'isAdmin',
                'email' => 'Admin@dummy.com',
                'password' => bcrypt('123'),
                'photo' => 'images.png',
                'roles_id' => 1
            ]
        ];
        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}
