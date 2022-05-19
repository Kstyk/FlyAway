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
                    'nazwa_linii' => 'RyanAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 5,
                    'data_wylotu' => '2022-06-14'
                ],
                [
                    'trip_id' => 1,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 3,
                    'data_wylotu' => '2022-06-12'
                ],
                [
                    'trip_id' => 1,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 3,
                    'data_wylotu' => '2022-06-11'
                ],
                [
                    'trip_id' => 2,
                    'nazwa_linii' => 'Qatar Airlines',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 2,
                    'data_wylotu' => '2022-06-11'
                ],
                [
                    'trip_id' => 3,
                    'nazwa_linii' => 'Qatar Airlines',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 4,
                    'data_wylotu' => '2022-06-22'
                ],
                [
                    'trip_id' => 5,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 6,
                    'data_wylotu' => '2022-06-11'
                ],
                [
                    'trip_id' => 5,
                    'nazwa_linii' => 'LOT',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 6,
                    'data_wylotu' => '2022-06-13'
                ],
                [
                    'trip_id' => 6,
                    'nazwa_linii' => 'RyanAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 8,
                    'data_wylotu' => '2022-06-22'
                ],
                [
                    'trip_id' => 6,
                    'nazwa_linii' => 'RyanAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 7,
                    'data_wylotu' => '2022-06-15'
                ],
                [
                    'trip_id' => 6,
                    'nazwa_linii' => 'RyanAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 7,
                    'data_wylotu' => '2022-06-22'
                ],
                [
                    'trip_id' => 7,
                    'nazwa_linii' => 'RyanAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 8,
                    'data_wylotu' => '2022-06-12'
                ],
                [
                    'trip_id' => 8,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 9,
                    'data_wylotu' => '2022-05-30'
                ],
                [
                    'trip_id' => 8,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 9,
                    'data_wylotu' => '2022-05-31'
                ],
                [
                    'trip_id' => 9,
                    'nazwa_linii' => 'LOT',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 10,
                    'data_wylotu' => '2022-06-01'
                ],
                [
                    'trip_id' => 10,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 13,
                    'data_wylotu' => '2022-06-22'
                ],
                [
                    'trip_id' => 10,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 12,
                    'airport_id_2' => 13,
                    'data_wylotu' => '2022-06-24'
                ],
                [
                    'trip_id' => 11,
                    'nazwa_linii' => 'WizzAir',
                    'liczba_miejsc' => 100,
                    'airport_id' => 11,
                    'airport_id_2' => 14,
                    'data_wylotu' => '2022-06-22'
                ],
            ],
            'trip_id'
        );
    }
}
