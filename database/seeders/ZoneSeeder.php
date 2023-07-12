<?php

namespace Database\Seeders;

use App\Models\Tariff;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Zones
        $zonesData = [
            ['name' => 'А0 – Sredno Vodno'],
            ['name' => 'А02 – Parking lot - Pantelejmon'],
            ['name' => 'А06 – Parking lot - Maksim Gorki'],
            ['name' => 'А1 – Parking lot - Agromehanika'],
            ['name' => 'А3 – Parking lot - Dame Gruev 1'],
            ['name' => 'А4 – Parking lot - Dame Gruev 2'],
            ['name' => 'А5 – Parking lot - Orce Nikolov'],
            ['name' => 'А8 – Parking lot - Kamen Most'],
            ['name' => 'B2 – Parking lot - Bristol'],
            ['name' => 'B3 – Parking lot - Bristol 2'],
            ['name' => 'B6 – Parking lot - Josip Broz'],
            ['name' => 'B7 – Parking lot - Ilinden'],
            ['name' => 'B10 – Parking lot - Vodovod'],
            ['name' => 'C8 – Parking lot - Debar Maalo'],
            ['name' => 'C9 – Parking lot - Deabr Maalo'],
            ['name' => 'C15 – Parking lot - Gjuro Gjakovic'],
            ['name' => 'C17 – Parking lot - Leninova'],
            ['name' => 'C19 – Parking lot - Univerzalna Sala'],
            ['name' => 'C33 – Parking lot - Transporten Centar'],
            ['name' => 'C35 – Parking lot - Sproti Depo Pajak'],
            ['name' => 'C45 – Parking lot - Manu, MTV, Sudska'],
            ['name' => 'C46 – Parking lot - Prodolzenie na C45'],
            ['name' => 'C80 – Parking lot - Zooloska'],
            ['name' => 'C81 – Parking lot - Gradsko Sobranie'],
            ['name' => 'D3 – Parking lot - TC Biser'],
            ['name' => 'D4 – Parking lot - Vero - Rudarski'],
            ['name' => 'D5 – Parking lot - Vladimir Komarov'],
            ['name' => 'D6 – Parking lot - Palma Aerodrom'],
            ['name' => 'D7 – Parking lot - Aerodrom Glorija'],
            ['name' => 'D8 – Parking lot - Pozadi ONE'],
            ['name' => 'D40 – Parking lot - 8mi Septemvri'],
            ['name' => 'D62 – Parking lot - Tenisko ABC'],
            ['name' => 'D1 – Parking lot - Hotel Rusija'],
            ['name' => 'D2 – Parking lot - Tri Biseri'],
            ['name' => 'D9 – Parking lot - CRKVA'],
            ['name' => 'D8 – Parking lot - Bojmija/Komarov'],
        ];

        $zones = Zone::insert($zonesData);

        // Create tariffs
        $tariffsData = [
            // Zone А0 tariffs
            [
                'zone_name' => 'А0 – Sredno Vodno',
                'first_hour_price' => 75,
                'additional_hour_price' => 50,
                'time_limit' => 2
            ],
            [
                'zone_name' => 'А02 – Parking lot - Pantelejmon',
                'first_hour_price' => 75,
                'additional_hour_price' => 50,
                'time_limit' => 2
            ],
            [
                'zone_name' => 'А06 – Parking lot - Maksim Gorki',
                'first_hour_price' => 75,
                'additional_hour_price' => 50,
                'time_limit' => 2
            ],

            // Other zones with the same price for all hours
            ['zone_name' => 'А1 – Parking lot - Agromehanika', 'price' => 40, 'time_limit' => 2],
            ['zone_name' => 'А3 – Parking lot - Dame Gruev 1', 'price' => 40, 'time_limit' => 2],
            ['zone_name' => 'А4 – Parking lot - Dame Gruev 2', 'price' => 40, 'time_limit' => 2],
            ['zone_name' => 'А5 – Parking lot - Orce Nikolov', 'price' => 40, 'time_limit' => 2],
            ['zone_name' => 'А8 – Parking lot - Kamen Most', 'price' => 40, 'time_limit' => 2],

            // Zone B tariffs
            ['zone_name' => 'B2 – Parking lot - Bristol', 'price' => 30, 'time_limit' => 4],
            ['zone_name' => 'B3 – Parking lot - Bristol 2', 'price' => 30, 'time_limit' => 4],
            ['zone_name' => 'B6 – Parking lot - Josip Broz', 'price' => 30, 'time_limit' => 4],
            ['zone_name' => 'B7 – Parking lot - Ilinden', 'price' => 30, 'time_limit' => 4],
            ['zone_name' => 'B10 – Parking lot - Vodovod', 'price' => 30, 'time_limit' => 4],

            // Zone C tariffs
            ['zone_name' => 'C15 – Parking lot - Gjuro Gjakovic', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C17 – Parking lot - Leninova', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C19 – Parking lot - Univerzalna Sala', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C33 – Parking lot - Transporten Centar', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C35 – Parking lot - Sproti Depo Pajak', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C45 – Parking lot - Manu, MTV, Sudska', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C46 – Parking lot - Prodolzenie na C45', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C80 – Parking lot - Zooloska', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'C81 – Parking lot - Gradsko Sobranie', 'price' => 25, 'time_limit' => null],

            // Zone D tariffs
            ['zone_name' => 'D3 – Parking lot - TC Biser', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D4 – Parking lot - Vero - Rudarski', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D5 – Parking lot - Vladimir Komarov', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D6 – Parking lot - Palma Aerodrom', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D7 – Parking lot - Aerodrom Glorija', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D8 – Parking lot - Pozadi ONE', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D40 – Parking lot - 8mi Septemvri', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D62 – Parking lot - Tenisko ABC', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D1 – Parking lot - Hotel Rusija', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D2 – Parking lot - Tri Biseri', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D9 – Parking lot - CRKVA', 'price' => 25, 'time_limit' => null],
            ['zone_name' => 'D8 – Parking lot - Bojmija/Komarov', 'price' => 25, 'time_limit' => null],
        ];

        foreach ($tariffsData as $tariffData) {
            $zoneName = $tariffData['zone_name'];
            $zone = Zone::where('name', $zoneName)->first();

            if ($zone) {
                // Create the tariff for the zone
                if (isset($tariffData['first_hour_price'])) {
                    $firstHourPrice = $tariffData['first_hour_price'];
                    $additionalHourPrice = $tariffData['additional_hour_price'];
                    $tariff = new Tariff();
                    $tariff->zone_id = $zone->id;
                    $tariff->price = $firstHourPrice;
                    $tariff->time_limit = 1;
                    $tariff->save();

                    $tariff = new Tariff();
                    $tariff->zone_id = $zone->id;
                    $tariff->price = $additionalHourPrice;
                    $tariff->time_limit = 1;
                    $tariff->save();
                } else {
                    $price = $tariffData['price'];
                    $timeLimit = $tariffData['time_limit'];
                    $tariff = new Tariff();
                    $tariff->zone_id = $zone->id;
                    $tariff->price = $price;
                    $tariff->time_limit = $timeLimit;
                    $tariff->save();
                }
            } else {
                echo "Zone '$zoneName' not found. Skipping tariff creation.";
            }
        }
    }
}
