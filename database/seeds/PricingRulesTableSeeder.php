<?php

use Illuminate\Database\Seeder;
use App\PricingRule;

class PricingRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get customer records
        $unilever = DB::table('customers')->where('name', 'Unilever')->first();
        $apple = DB::table('customers')->where('name', 'Apple')->first();
        $nike = DB::table('customers')->where('name', 'Nike')->first();
        $ford = DB::table('customers')->where('name', 'Ford')->first();

        $data = [
            [
                'customer_id' => $unilever->id,
                'ad_id' => 'classic',
                'price' => 179.9933,
                'min_qty' => 3,
                'continuous' => false
            ],
            [
                'customer_id' => $apple->id,
                'ad_id' => 'standout',
                'price' => 299.99,
                'min_qty' => 1,
                'continuous' => true
            ],
            [
                'customer_id' => $nike->id,
                'ad_id' => 'premium',
                'price' => 379.99,
                'min_qty' => 4,
                'continuous' => true
            ],
            [
                'customer_id' => $ford->id,
                'ad_id' => 'classic',
                'price' => 215.992,
                'min_qty' => 5,
                'continuous' => false
            ],
            [
                'customer_id' => $ford->id,
                'ad_id' => 'standout',
                'price' => 309.99,
                'min_qty' => 1,
                'continuous' => true
            ],
            [
                'customer_id' => $ford->id,
                'ad_id' => 'premium',
                'price' => 389.99,
                'min_qty' => 3,
                'continuous' => true
            ]
        ];

        foreach ($data as $pricingRuleData) {
            $pricingRule = new PricingRule();
            $pricingRule->customer_id = $pricingRuleData['customer_id'];
            $pricingRule->ad_id = $pricingRuleData['ad_id'];
            $pricingRule->price = $pricingRuleData['price'];
            $pricingRule->min_qty = $pricingRuleData['min_qty'];
            $pricingRule->continuous = $pricingRuleData['continuous'];
            $pricingRule->save();
        }
    }
}