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
     * Test checkout for customer Unilever
     *
     * @return void
     */
    public function testCheckoutDefault()
    {
        $customer = Customer::where('name', 'Tissot')->first();
        $items = ['classic', 'standout', 'premium'];

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

    /**
     * Test checkout for customer Unilever
     *
     * @return void
     */
    public function testCheckoutDefault2()
    {
        $customer = Customer::where('name', 'Chase')->first();
        $items = ['classic', 'classic', 'classic', 'premium'];

        $response = $this->json('POST', 'api/checkout', [
            'customer_id' => $customer->id,
            'items' => $items
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => 1204.96
            ]);
    }

    /**
     * Test checkout for customer Unilever
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
                'total' => 934.97
            ]);
    }

    /**
     * Test checkout for customer Unilever
     *
     * @return void
     */
    public function testCheckoutUnilever2()
    {
        $customer = Customer::where('name', 'Unilever')->first();
        $items = ['classic', 'classic', 'classic', 'classic', 'premium'];

        $response = $this->json('POST', 'api/checkout', [
            'customer_id' => $customer->id,
            'items' => $items
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => 1204.96
            ]);
    }

    /**
     * Test checkout for customer Apple
     *
     * @return void
     */
    public function testCheckoutApple()
    {
        $customer = Customer::where('name', 'Apple')->first();
        $items = ['standout', 'standout', 'standout', 'premium'];

        $response = $this->json('POST', 'api/checkout', [
            'customer_id' => $customer->id,
            'items' => $items
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => 1294.96
            ]);
    }

    /**
     * Test checkout for customer Apple
     *
     * @return void
     */
    public function testCheckoutNike()
    {
        $customer = Customer::where('name', 'Nike')->first();
        $items = ['premium', 'premium', 'premium', 'premium'];

        $response = $this->json('POST', 'api/checkout', [
            'customer_id' => $customer->id,
            'items' => $items
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => 1519.96
            ]);
    }
}
