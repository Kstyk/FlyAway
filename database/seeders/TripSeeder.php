<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
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
        Schema::enableForeignKeyConstraints();
        Trip::upsert(
            [
                [
                    'nazwa' => 'Kolorado',
                    'kontynent' => 'Ameryka Północna',
                    'okres_trwania' => 14,
                    'opis' => Str::random(150),
                    'cena' => 3200,
                    'country_id' => '1'
                ],
                [
                    'nazwa' => 'Szanghaj',
                    'kontynent' => 'Azja',
                    'okres_trwania' => 14,
                    'opis' => Str::random(150),
                    'cena' => 5000,
                    'country_id' => '3'
                ],
                [
                    'nazwa' => 'Dubaj',
                    'kontynent' => 'Azja',
                    'okres_trwania' => 7,
                    'opis' => Str::random(150),
                    'cena' => 5000,
                    'country_id' => '4'
                ],
                [
                    'nazwa' => 'Tokio',
                    'kontynent' => 'Azja',
                    'okres_trwania' => 7,
                    'opis' => 'stolica i największe miasto Japonii, położone na największej japońskiej wyspie Honsiu, nad Oceanem Spokojnym. Obszar miasta stanowi najgęściej zaludniony obszar na świecie. Wraz z Jokohamą i innymi miastami nad Zatoką Tokijską tworzy aglomerację zamieszkiwaną przez ponad 30 mln mieszkańców.',
                    'cena' => 6000,
                    'country_id' => '5'
                ],
                [
                    'nazwa' => 'Szkocja i okolice',
                    'kontynent' => 'Europa',
                    'okres_trwania' => 15,
                    'opis' => Str::random(150),
                    'cena' => 8000,
                    'country_id' => '6'
                ],
                [
                    'nazwa' => 'Paryż i Alpy',
                    'kontynent' => 'Europa',
                    'okres_trwania' => 14,
                    'opis' => Str::random(150),
                    'cena' => 4000,
                    'country_id' => '7'
                ],
                [
                    'nazwa' => 'Amsterdam',
                    'kontynent' => 'Europa',
                    'okres_trwania' => 7,
                    'opis' => Str::random(150),
                    'cena' => 3000,
                    'country_id' => '8'
                ],
                [
                    'nazwa' => 'Seul',
                    'kontynent' => 'Azja',
                    'okres_trwania' => 21,
                    'opis' => Str::random(150),
                    'cena' => 12000,
                    'country_id' => '9'
                ],
                [
                    'nazwa' => 'Schwarzwald',
                    'kontynent' => 'Europa',
                    'okres_trwania' => 14,
                    'opis' => Str::random(150),
                    'cena' => 3000,
                    'country_id' => '10'
                ],
                [
                    'nazwa' => 'Brazylijska różnorodność',
                    'kontynent' => 'Ameryka Południowa',
                    'okres_trwania' => 14,
                    'opis' => Str::random(150),
                    'cena' => 8000,
                    'country_id' => '11'
                ],
                [
                    'nazwa' => 'Safari',
                    'kontynent' => 'Afryka',
                    'okres_trwania' => 12,
                    'opis' => Str::random(150),
                    'cena' => 7000,
                    'country_id' => '12'
                ]
            ], 'nazwa'
        );
    }
}
