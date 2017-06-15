<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Unilever'],
            ['name' => 'Apple'],
            ['name' => 'Nike'],
            ['name' => 'Ford'],
            ['name' => 'Tissot'],
            ['name' => 'Chase']
        ];

        foreach ($data as $customerData) {
            $customer = new Customer();
            $customer->name = $customerData['name'];
            $customer->save();
        }
    }
}

