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
                    'airport_id' => 11,
                    'airport_id_2' => 5,
                    'data_wylotu' => '2022-06-14'
                ]
            ],
            'trip_id'
        );
    }
}
