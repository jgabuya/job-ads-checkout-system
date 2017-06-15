<?php

namespace App\Modules\Checkout;

use PriceCalculator;

class Checkout
{
    private $cart;
    private $priceCalculator;
    private $customerId;

    /**
     * Checkout constructor.
     * @param \App\Modules\Checkout\PriceCalculator $myPriceCalculator
     */
    function __construct(PriceCalculator $myPriceCalculator)
    {
        // initialize properties
        $this->cart = [];
        $this->total = 0;
        $this->priceCalculator = $myPriceCalculator;
    }

    /**
     * Sets the customerId property
     * @param $myCustomerId
     * @return $this
     */
    public function setCustomerId($myCustomerId)
    {
        $this->customerId = $myCustomerId;
        return $this;
    }

    /**
     * Adds an item to cart
     * @param array $item
     * @return $this
     */
    public function add(array $item)
    {
        array_push($this->cart, $item);
        return $this;
    }

    /**
     * Returs the total price
     * @return mixed
     */
    public function total()
    {
        return $this->priceCalculator->total($this->items);
    }
}