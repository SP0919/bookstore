<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shops;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path('assets/js/products.json');
        $data = file_get_contents($filename);
        $array = json_decode($data, true);
        foreach ($array as $value) {
            Shops::create([

                'title' => $value['title'], 'description' => $value['description'], 'address_line_1' => $value['address_line_1'], 'address_line_2' => $value['address_line_2'], 'city' => $value['city'], 'state_id' => $value['state_id'], 'zipcode' => $value['zipcode'], 'country_id' => $value['country_id'], 'user_id' => $value['user_id'], 'features' => $value['features'], 'status' => $value['status'], 'latitude' => $value['latitude'], 'longitude' => $value['longitude']
            ]);
        }
    }
}
