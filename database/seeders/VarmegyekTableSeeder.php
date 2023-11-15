<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Varmegye;

class VarmegyekTableSeeder extends Seeder
{
    
    const ITEMS = [
        'Bács-Kiskun megye',
        'Baranya megye',
        'Békés megye',
        'Borsod-Abaúj-Zemplén megye',
        'Budapest (főváros)',
        'Csongrád-Csanád megye',
        'Fejér megye',
        'Győr-Moson-Sopron megye',
        'Hajdú-Bihar megye',
        'Heves megye',
        'Jász-Nagykun-Szolnok megye',
        'Komárom-Esztergom megye',
        'Nógrád megye',
        'Pest megye',
        'Somogy megye',
        'Szabolcs-Szatmár-Bereg megye',
        'Tolna megye',
        'Vas megye',
        'Veszprém megye',
        'Zala megye'

    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::ITEMS as $item) {
            $entity = new Varmegye(['name' => $item]);
            $entity->save();
        }
    }

}
