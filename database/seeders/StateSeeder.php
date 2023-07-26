<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\States;
use App\Models\Countries;
use DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $filename = public_path('assets/js/states.json');
        $data = file_get_contents($filename);
        $array = json_decode($data, true);
        foreach ($array as $value) {


            $country = DB::table('countries')->where('country_code', $value['country_code'])->first();
            if ($country->country_code ==  $value['country_code']) {
                States::create([

                    'name' => $value['name'], 'country_id' => $country->id, 'state_code' => $value['state_code'], 'type' => $value['type'] ? $value['type'] : "Point", 'latitude' => $value['latitude'], 'longitude' => $value['longitude']
                ]);
            }
        }
    }
}
