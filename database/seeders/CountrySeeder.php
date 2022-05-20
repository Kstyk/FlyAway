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
                    'nazwa' => 'Stany Zjednoczone',
                    'iso3166' => 'US',
                    'waluta' => 'Dolar amerykański',
                    'powierzchnia_calkowita' => 9833520,
                    'jezyk_urzedowy' => 'angielski'
                ],
                [
                    'nazwa' => 'Polska',
                    'iso3166' => 'PL',
                    'waluta' => 'złoty',
                    'powierzchnia_calkowita' => 312696,
                    'jezyk_urzedowy' => 'polski'
                ],
                [
                    'nazwa' => 'Chiny',
                    'iso3166' => 'CN',
                    'waluta' => 'yuan',
                    'powierzchnia_calkowita' => 9596960,
                    'jezyk_urzedowy' => 'mandaryński'
                ],
                [
                    'nazwa' => 'Zjednoczone Emiraty Arabskie',
                    'iso3166' => 'AE',
                    'waluta' => 'dirham',
                    'powierzchnia_calkowita' => 83600,
                    'jezyk_urzedowy' => 'arabski'
                ],
                [
                    'nazwa' => 'Japonia',
                    'iso3166' => 'JP',
                    'waluta' => 'jen',
                    'powierzchnia_calkowita' => 377972,
                    'jezyk_urzedowy' => 'japoński'
                ],
                [
                    'nazwa' => 'Wielka Brytania',
                    'iso3166' => 'GB',
                    'waluta' => 'funt szterling',
                    'powierzchnia_calkowita' => 244820,
                    'jezyk_urzedowy' => 'angielski'
                ],
                [
                    'nazwa' => 'Francja',
                    'iso3166' => 'FR',
                    'waluta' => 'euro',
                    'powierzchnia_calkowita' => 643801,
                    'jezyk_urzedowy' => 'francuski'
                ],
                [
                    'nazwa' => 'Holandia',
                    'iso3166' => 'NL',
                    'waluta' => 'euro',
                    'powierzchnia_calkowita' => 41526,
                    'jezyk_urzedowy' => 'niderlandzki'
                ],
                [
                    'nazwa' => 'Korea Południowa',
                    'iso3166' => 'KR',
                    'waluta' => 'won południowokoreański',
                    'powierzchnia_calkowita' => 100210,
                    'jezyk_urzedowy' => 'koreański'
                ],
                [
                    'nazwa' => 'Niemcy',
                    'iso3166' => 'DE',
                    'waluta' => 'euro',
                    'powierzchnia_calkowita' => 357578,
                    'jezyk_urzedowy' => 'niemiecki'
                ],
                [
                    'nazwa' => 'Brazylia',
                    'iso3166' => 'BR',
                    'waluta' => 'real brazylijski',
                    'powierzchnia_calkowita' => 8515767,
                    'jezyk_urzedowy' => 'portugalski'
                ],
                [
                    'nazwa' => 'Republika Południowej Afryki',
                    'iso3166' => 'ZA',
                    'waluta' => 'rand',
                    'powierzchnia_calkowita' => 1219090,
                    'jezyk_urzedowy' => 'angielski'
                ],
                [
                    'nazwa' => 'Algieria',
                    'iso3166' => 'DZ',
                    'waluta' => 'dinar algierski',
                    'powierzchnia_calkowita' => 2381741,
                    'jezyk_urzedowy' => 'arabski'
                ],
            ],
            'nazwa'
        );
    }
}
