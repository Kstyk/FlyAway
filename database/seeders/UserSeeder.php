<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\UserFlightSeeder;
use Illuminate\Support\Facades\Schema;
use App\Models\UserFlight;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        UserFlight::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::upsert([
            [
                'name' => 'Adam',
                'surname' => 'Kowal',
                'date_of_birth' => '1992',
                'email' => 'administrator@flyaway.pl',
                'password' => Hash::make('admin'),
                'country_id' => '2',
                'role_id' => '1'
            ],
            [
                'name' => 'Marcin',
                'surname' => 'Nowomiejski',
                'date_of_birth' => '1995',
                'email' => 'm.nowomiejski@gmail.com',
                'password' => Hash::make('1234'),
                'country_id' => '2',
                'role_id' => '2'
            ],
            [
                'name' => 'Kamil',
                'surname' => 'Kowalski',
                'date_of_birth' => '1982',
                'email' => 'k.kowalski@gmail.com',
                'password' => Hash::make('1234'),
                'country_id' => '2',
                'role_id' => '2'
            ],
            [
                'name' => 'Jan',
                'surname' => 'Okrasa',
                'date_of_birth' => '1992',
                'email' => 'j.okrasa@gmail.com',
                'password' => Hash::make('1234'),
                'country_id' => '2',
                'role_id' => '2'
            ]
        ], 'email'
        );
    }
}
