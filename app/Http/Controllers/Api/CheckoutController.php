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

        $priceCalculator = new PriceCalculator(PricingRule::all());
        $checkoutModule = new Checkout(
            Customer::find($request->input('customer_id')),
            $priceCalculator
        );

        foreach ($request->input('items') as $adId) {
            $checkoutModule->add(Ad::find($adId));
        }

        return $checkoutModule->total();
    }
}
