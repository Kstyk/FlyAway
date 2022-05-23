<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\UserFlight;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        UserFlight::truncate();
        Flight::truncate();
        Schema::enableForeignKeyConstraints();
        Flight::upsert(
            [
                [
                    'trip_id' => 4,
                    'airline_name' => 'RyanAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 5,
                    'departure_date' => '2022-06-14'
                ],
                [
                    'trip_id' => 1,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 3,
                    'departure_date' => '2022-06-12'
                ],
                [
                    'trip_id' => 1,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 3,
                    'departure_date' => '2022-06-11'
                ],
                [
                    'trip_id' => 2,
                    'airline_name' => 'Qatar Airlines',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 2,
                    'departure_date' => '2022-06-11'
                ],
                [
                    'trip_id' => 3,
                    'airline_name' => 'Qatar Airlines',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 4,
                    'departure_date' => '2022-06-22'
                ],
                [
                    'trip_id' => 5,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 6,
                    'departure_date' => '2022-06-11'
                ],
                [
                    'trip_id' => 5,
                    'airline_name' => 'LOT',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 6,
                    'departure_date' => '2022-06-13'
                ],
                [
                    'trip_id' => 6,
                    'airline_name' => 'RyanAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 8,
                    'departure_date' => '2022-06-22'
                ],
                [
                    'trip_id' => 6,
                    'airline_name' => 'RyanAir',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 7,
                    'departure_date' => '2022-06-15'
                ],
                [
                    'trip_id' => 6,
                    'airline_name' => 'RyanAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 7,
                    'departure_date' => '2022-06-22'
                ],
                [
                    'trip_id' => 7,
                    'airline_name' => 'RyanAir',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 8,
                    'departure_date' => '2022-06-12'
                ],
                [
                    'trip_id' => 8,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 9,
                    'departure_date' => '2022-05-30'
                ],
                [
                    'trip_id' => 8,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 9,
                    'departure_date' => '2022-05-31'
                ],
                [
                    'trip_id' => 9,
                    'airline_name' => 'LOT',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 10,
                    'departure_date' => '2022-06-01'
                ],
                [
                    'trip_id' => 10,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 13,
                    'departure_date' => '2022-06-22'
                ],
                [
                    'trip_id' => 10,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 12,
                    'destination_airport' => 13,
                    'departure_date' => '2022-06-24'
                ],
                [
                    'trip_id' => 11,
                    'airline_name' => 'WizzAir',
                    'places' => 100,
                    'departure_airport' => 11,
                    'destination_airport' => 14,
                    'departure_date' => '2022-06-22'
                ],
                [
                    'trip_id' => 11,
                    'airline_name' => 'WizzAir',
                    'places' => 5,
                    'departure_airport' => 11,
                    'destination_airport' => 14,
                    'departure_date' => '2022-05-10'
                ],
            ],
            'trip_id'
        );
    }
}
