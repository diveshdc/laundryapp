<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'first_name'     => 'Admin',
            'last_name'      => 'Divesh',
            'building_name_no'=> 'xyz',
            'street_name'    => 'test',
            'town'           => 'abc',
            'post_code'      => '766h',
            'reference_from' => 'dad',
            'vehicle_number' =>  'UK 04 j 1234',
            'phone_number'   =>  '1231231234',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO',
            'remember_token' => null,
            'created_at'     => '2019-04-15 19:13:32',
            'updated_at'     => '2019-04-15 19:13:32',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
