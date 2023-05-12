<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'username' => 'user',
                'email' => 'use2@gmail.com',
                "password" => bcrypt("UserIn1!"),
                'isAdmin' => 0,
                'point' => 0,
                'created_at' => Carbon::now()->subMinutes(11),
                'updated_at' => Carbon::now()->subMinutes(11),
            ],
        ];
         User::insert($data);
    }
}
