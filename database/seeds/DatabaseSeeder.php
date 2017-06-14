<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(PricingRulesTableSeeder::class);
    }
}
