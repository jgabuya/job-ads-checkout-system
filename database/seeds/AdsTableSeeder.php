<?php

use Illuminate\Database\Seeder;
use App\Ad;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 'classic', 'name' => 'Classic Ad', 'price' => 269.99],
            ['id' => 'standout', 'name' => 'Standout Ad', 'price' => 322.99],
            ['id' => 'premium', 'name' => 'Premium Ad', 'price' => 394.99]
        ];

        foreach ($data as $adData) {
            $ad = new Ad();
            $ad->id = $adData['id'];
            $ad->name = $adData['name'];
            $ad->price = $adData['price'];
            $ad->save();
        }
    }
}
