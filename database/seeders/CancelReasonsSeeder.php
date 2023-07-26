<?php

namespace Database\Seeders;

use App\Models\OrderCancelReasons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CancelReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderCancelReasons::insert([
            [
                'title' => 'Change in Plan!',

            ],
            [
                'title' => 'Get a good deal somewhere else!',

            ],
            [
                'title' => 'Change in delivery address.',

            ],
            [
                'title' => 'Other',

            ],
        ]);
    }
}
