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
                'name' => 'Hartsfield-Jackson Atlanta International Airport',
                'country_id' => 1,
                'city' => 'Atlanta'
            ],
            [
                'name' => 'Międzynarodowe Lotnisko w Pekinie',
                'country_id' => 3,
                'city' => 'Pekin'
            ],
            [
                'name' => 'Los Angeles International Airport',
                'country_id' => 1,
                'city' => 'Los Angeles'
            ],
            [
                'name' => 'Dubai International Airport',
                'country_id' => 4,
                'city' => 'Dubaj'
            ],
            [
                'name' => 'Tokio Haneda Airport',
                'country_id' => 5,
                'city' => 'Tokio'
            ],
            [
                'name' => 'Heathrow Airport',
                'country_id' => 6,
                'city' => 'Londyn'
            ],
            [
                'name' => 'Charles de Gaulle Airport',
                'country_id' => 7,
                'city' => 'Paryż'
            ],
            [
                'name' => 'Schiphol Airport',
                'country_id' => 8,
                'city' => 'Amsterdam'
            ],
            [
                'name' => 'Incheon International Airport',
                'country_id' => 9,
                'city' => 'Seul'
            ],
            [
                'name' => 'Frankfurt Airport',
                'country_id' => 10,
                'city' => 'Frankfurt'
            ],
            [
                'name' => 'Lotnisko Chopina w Warszawie',
                'country_id' => 2,
                'city' => 'Warszawa'
            ],
            [
                'name' => 'Port lotniczy Kraków-Balice',
                'country_id' => 2,
                'city' => 'Kraków'
            ],
            [
                'name' => 'Rio de Janeiro International Airport',
                'country_id' => 11,
                'city' => 'Rio de Janeiro'
            ],
            [
                'name' => 'O. R. Tambo International Airport',
                'country_id' => 12,
                'city' => 'Johannesburg'
            ],
            [
                'name' => 'Port lotniczy Kijów-Boryspol',
                'country_id' => 14,
                'city' => 'Kijów'
            ],
            [
                'name' => 'Port lotniczy Algier',
                'country_id' => 13,
                'city' => 'Algier'
            ],
            [
                'name' => 'Port lotniczy Lima-Jorge Chávez',
                'country_id' => 15,
                'city' => 'Callao'
            ],
            [
                'name' => 'Port lotniczy Bangkok-Suvarnabhumi',
                'country_id' => 16,
                'city' => 'Bangkok'
            ]
        ],
        'name'
    );
    }
}
