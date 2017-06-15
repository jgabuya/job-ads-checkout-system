<?php

namespace App\Modules\Checkout;

use App\Customer;
use App\Order;

class Checkout
{
    private $cart;
    private $priceCalculator;
    private $customer;

    /**
     * Checkout constructor.
     * @param Customer $myCustomer
     * @param PriceCalculator $myPriceCalculator
     */
    function __construct(Customer $myCustomer, PriceCalculator $myPriceCalculator)
    {
        // initialize properties
        $this->cart = collect([]);
        $this->customer = $myCustomer;
        $this->total = 0;
        $this->priceCalculator = $myPriceCalculator;
    }

    /**
     * Adds an item to cart
     * @param array $item
     * @return $this
     */
    public function add($item)
    {
        $this->cart->push($item);
        return $this;
    }

    /**
     * Returns the total price
     * @return mixed
     */
    public function total()
    {
        return $this->priceCalculator->total($this->customer, $this->cart);
    }

    /**
     * Creates an Order DB entry
     * @return mixed
     */
    public function saveOrder()
    {
        $order = new Order();
        $order->customer_id = $this->customer->id;
        $order->items = $this->cart->pluck('id')->toJson();
        $order->total = $this->total();
        $order->save();

        return $order->id;
    }
}