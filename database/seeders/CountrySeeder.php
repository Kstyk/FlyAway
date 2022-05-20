<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;
use App\Models\Trip;
use App\Models\Airport;
use App\Models\User;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Trip::truncate();
        Airport::truncate();
        User::truncate();
        Country::truncate();
        Schema::enableForeignKeyConstraints();
        Country::upsert(
            [
                [
                    'name' => 'Stany Zjednoczone',
                    'iso3166' => 'US',
                    'currency' => 'Dolar amerykański',
                    'total_surface' => 9833520,
                    'language' => 'angielski'
                ],
                [
                    'name' => 'Polska',
                    'iso3166' => 'PL',
                    'currency' => 'złoty',
                    'total_surface' => 312696,
                    'language' => 'polski'
                ],
                [
                    'name' => 'Chiny',
                    'iso3166' => 'CN',
                    'currency' => 'yuan',
                    'total_surface' => 9596960,
                    'language' => 'mandaryński'
                ],
                [
                    'name' => 'Zjednoczone Emiraty Arabskie',
                    'iso3166' => 'AE',
                    'currency' => 'dirham',
                    'total_surface' => 83600,
                    'language' => 'arabski'
                ],
                [
                    'name' => 'Japonia',
                    'iso3166' => 'JP',
                    'currency' => 'jen',
                    'total_surface' => 377972,
                    'language' => 'japoński'
                ],
                [
                    'name' => 'Wielka Brytania',
                    'iso3166' => 'GB',
                    'currency' => 'funt szterling',
                    'total_surface' => 244820,
                    'language' => 'angielski'
                ],
                [
                    'name' => 'Francja',
                    'iso3166' => 'FR',
                    'currency' => 'euro',
                    'total_surface' => 643801,
                    'language' => 'francuski'
                ],
                [
                    'name' => 'Holandia',
                    'iso3166' => 'NL',
                    'currency' => 'euro',
                    'total_surface' => 41526,
                    'language' => 'niderlandzki'
                ],
                [
                    'name' => 'Korea Południowa',
                    'iso3166' => 'KR',
                    'currency' => 'won południowokoreański',
                    'total_surface' => 100210,
                    'language' => 'koreański'
                ],
                [
                    'name' => 'Niemcy',
                    'iso3166' => 'DE',
                    'currency' => 'euro',
                    'total_surface' => 357578,
                    'language' => 'niemiecki'
                ],
                [
                    'name' => 'Brazylia',
                    'iso3166' => 'BR',
                    'currency' => 'real brazylijski',
                    'total_surface' => 8515767,
                    'language' => 'portugalski'
                ],
                [
                    'name' => 'Republika Południowej Afryki',
                    'iso3166' => 'ZA',
                    'currency' => 'rand',
                    'total_surface' => 1219090,
                    'language' => 'angielski'
                ],
                [
                    'name' => 'Algieria',
                    'iso3166' => 'DZ',
                    'currency' => 'dinar algierski',
                    'total_surface' => 2381741,
                    'language' => 'arabski'
                ],
            ],
            'name'
        );
    }
}
