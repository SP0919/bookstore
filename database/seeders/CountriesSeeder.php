<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countries;

class CountriesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path('assets/js/countries.json');
        $data = file_get_contents($filename);
        $array = json_decode($data, true);
        foreach ($array as $value) {
            Countries::create([

                'name' => $value['name'], 'country_code' => $value["iso2"], 'numeric_code' => $value['numeric_code'], 'phone_code' => $value['phone_code'],
                'capital' => $value['capital'], 'currency' => $value['currency'], 'region' => $value['region'], 'subregion' => $value['subregion'], 'timezones' => json_encode($value['timezones']), 'latitude' => $value['latitude'], 'longitude' => $value['longitude']
            ]);
        }
    }
}
