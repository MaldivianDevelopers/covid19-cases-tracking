<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$LQSrTNLnLkiB9JRr5rI66e8yb0S2OlA6Kmvh6vo9hE2t65EkpHLjK',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
