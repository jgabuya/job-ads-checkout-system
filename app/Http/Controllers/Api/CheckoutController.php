<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Modules\Checkout\Checkout;
use App\Modules\Checkout\PriceCalculator;
use App\PricingRule;
use Illuminate\Http\Request;
use Validator;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*' => 'exists:ads,id'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        // Initialize checkout class and its dependencies
        $priceCalculator = new PriceCalculator(PricingRule::all());
        $checkout = new Checkout(
            Customer::find($request->input('customer_id')),
            $priceCalculator
        );

        // Add items to cart
        foreach ($request->input('items') as $adId) {
            $checkout->add(Ad::find($adId));
        }

        // Save order to DB
        return response([
            'total' => $checkout->total(),
            'order' => url('ad-orders/' . $checkout->saveOrder())
        ], 200);
    }
}