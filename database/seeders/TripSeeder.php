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
                    'name' => 'Kolorado',
                    'continent' => 'Ameryka Północna',
                    'period' => 14,
                    'describe' => Str::random(150),
                    'price' => 3200,
                    'country_id' => '1',
                    'img_name' => 'p1.jpg'
                ],
                [
                    'name' => 'Szanghaj',
                    'continent' => 'Azja',
                    'period' => 14,
                    'describe' => Str::random(150),
                    'price' => 5000,
                    'country_id' => '3',
                    'img_name' => 'p2.jpg'
                ],
                [
                    'name' => 'Dubaj',
                    'continent' => 'Azja',
                    'period' => 7,
                    'describe' => Str::random(150),
                    'price' => 5000,
                    'country_id' => '4',
                    'img_name' => 'p3.jpg'
                ],
                [
                    'name' => 'Tokio',
                    'continent' => 'Azja',
                    'period' => 7,
                    'describe' => 'stolica i największe miasto Japonii, położone na największej japońskiej wyspie Honsiu, nad Oceanem Spokojnym. Obszar miasta stanowi najgęściej zaludniony obszar na świecie. Wraz z Jokohamą i innymi miastami nad Zatoką Tokijską tworzy aglomerację zamieszkiwaną przez ponad 30 mln mieszkańców.',
                    'price' => 6000,
                    'country_id' => '5',
                    'img_name' => 'p4.jpg'
                ],
                [
                    'name' => 'Szkocja i okolice',
                    'continent' => 'Europa',
                    'period' => 15,
                    'describe' => Str::random(150),
                    'price' => 8000,
                    'country_id' => '6',
                    'img_name' => 'p5.jpg'
                ],
                [
                    'name' => 'Paryż i Alpy',
                    'continent' => 'Europa',
                    'period' => 14,
                    'describe' => Str::random(150),
                    'price' => 4000,
                    'country_id' => '7',
                    'img_name' => 'p6.jpg'
                ],
                [
                    'name' => 'Amsterdam',
                    'continent' => 'Europa',
                    'period' => 7,
                    'describe' => Str::random(150),
                    'price' => 3000,
                    'country_id' => '8',
                    'img_name' => 'p7.jpg'
                ],
                [
                    'name' => 'Seul',
                    'continent' => 'Azja',
                    'period' => 21,
                    'describe' => Str::random(150),
                    'price' => 12000,
                    'country_id' => '9',
                    'img_name' => 'p8.jpg'
                ],
                [
                    'name' => 'Schwarzwald',
                    'continent' => 'Europa',
                    'period' => 14,
                    'describe' => Str::random(150),
                    'price' => 3000,
                    'country_id' => '10',
                    'img_name' => 'p9.jpg'
                ],
                [
                    'name' => 'Brazylijska różnorodność',
                    'continent' => 'Ameryka Południowa',
                    'period' => 14,
                    'describe' => Str::random(150),
                    'price' => 8000,
                    'country_id' => '11',
                    'img_name' => 'p10.jpg'
                ],
                [
                    'name' => 'Safari',
                    'continent' => 'Afryka',
                    'period' => 12,
                    'describe' => Str::random(150),
                    'price' => 7000,
                    'country_id' => '12',
                    'img_name' => 'p11.jpg'
                ],
                [
                    'name' => 'Sahara',
                    'continent' => 'Afryka',
                    'period' => 15,
                    'describe' => Str::random(150),
                    'price' => 4000,
                    'country_id' => '13',
                    'img_name' => 'p13.jpg'
                ],
                [
                    'name' => 'Czarnobyl',
                    'continent' => 'Europa',
                    'period' => 4,
                    'describe' => Str::random(150),
                    'price' => 1000,
                    'country_id' => '14',
                    'img_name' => 'p14.jpg'
                ],
                [
                    'name' => 'Andy',
                    'continent' => 'Ameryka Południowa',
                    'period' => 22,
                    'describe' => Str::random(150),
                    'price' => 4550,
                    'country_id' => '15',
                    'img_name' => 'p15.jpg'
                ],
                [
                    'name' => 'Bangkok',
                    'continent' => 'Azja',
                    'period' => 12,
                    'describe' => Str::random(150),
                    'price' => 2500,
                    'country_id' => '16',
                    'img_name' => 'p16.jpg'
                ],
            ], 'name'
        );
    }
}
