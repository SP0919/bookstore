<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cities;
use App\Models\States;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $States = States::all();
        $filename = public_path('assets/js/cities.json');
        $data = file_get_contents($filename);
        $array = json_decode($data, true);
        foreach ($array as $value) {
            foreach ($States as $state) {
                if ($state->state_code === $value['state_code'])
                    Cities::create([

                        'name' => $value['name'], 'state_id' => $state->id, 'latitude' => $value['latitude'], 'longitude' => $value['longitude'], 'wikiDataId' => $value['wikiDataId'],
                    ]);
            }
        }
    }
}
