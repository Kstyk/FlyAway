<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Airport;
use App\Models\Flight;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Flight::truncate();
        Airport::truncate();
        Schema::enableForeignKeyConstraints();
        Airport::upsert([
            [
                'nazwa' => 'Hartsfield-Jackson Atlanta International Airport',
                'country_id' => 1,
                'miasto' => 'Atlanta'
            ],
            [
                'nazwa' => 'Międzynarodowe Lotnisko w Pekinie',
                'country_id' => 3,
                'miasto' => 'Pekin'
            ],
            [
                'nazwa' => 'Los Angeles International Airport',
                'country_id' => 1,
                'miasto' => 'Los Angeles'
            ],
            [
                'nazwa' => 'Dubai International Airport',
                'country_id' => 4,
                'miasto' => 'Dubaj'
            ],
            [
                'nazwa' => 'Tokio Haneda Airport',
                'country_id' => 5,
                'miasto' => 'Tokio'
            ],
            [
                'nazwa' => 'Heathrow Airport',
                'country_id' => 6,
                'miasto' => 'Londyn'
            ],
            [
                'nazwa' => 'Charles de Gaulle Airport',
                'country_id' => 7,
                'miasto' => 'Paryż'
            ],
            [
                'nazwa' => 'Schiphol Airport',
                'country_id' => 8,
                'miasto' => 'Amsterdam'
            ],
            [
                'nazwa' => 'Incheon International Airport',
                'country_id' => 9,
                'miasto' => 'Seul'
            ],
            [
                'nazwa' => 'Frankfurt Airport',
                'country_id' => 10,
                'miasto' => 'Frankfurt'
            ],
            [
                'nazwa' => 'Lotnisko Chopina w Warszawie',
                'country_id' => 2,
                'miasto' => 'Warszawa'
            ],
            [
                'nazwa' => 'Port lotniczy Kraków-Balice',
                'country_id' => 2,
                'miasto' => 'Kraków'
            ],
            [
                'nazwa' => 'Rio de Janeiro International Airport',
                'country_id' => 11,
                'miasto' => 'Rio de Janeiro'
            ],
            [
                'nazwa' => 'O. R. Tambo International Airport',
                'country_id' => 12,
                'miasto' => 'Johannesburg'
            ]
        ],
        'nazwa'
    );
    }
}
