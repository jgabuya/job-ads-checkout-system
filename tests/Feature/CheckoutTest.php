<?php

namespace Tests\Feature;

use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutTest extends TestCase
{
    /**
     * Test checkout process
     *
     * @return void
     */
    public function testCheckoutUnilever()
    {
        $customer = Customer::where('name', 'Unilever')->first();
        $items = ['classic', 'classic', 'classic', 'premium'];

        $response = $this->json('POST', 'api/checkout', [
            'customer_id' => $customer->id,
            'items' => $items
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => 987.97
            ]);
    }
}
