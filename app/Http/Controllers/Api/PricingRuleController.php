<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Validation\Rule;
use App\PricingRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(PricingRule::all());
    }

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
            'customer_id' => 'required|exists:customers,id|unique_with:pricing_rules,ad_id',
            'ad_id' => 'required|exists:ads,id',
            'price' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'continuous' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        // Store new customer
        $pricingRule = new PricingRule();
        $pricingRule->customer_id = $request->input('customer_id');
        $pricingRule->ad_id = $request->input('ad_id');
        $pricingRule->price = $request->input('price');
        $pricingRule->min_qty = $request->input('min_qty');
        $pricingRule->continuous = $request->input('continuous');
        $pricingRule->save();

        return response(url('pricing-rules/' . $pricingRule->id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PricingRule  $pricingRule
     * @return \Illuminate\Http\Response
     */
    public function show(PricingRule $pricingRule)
    {
        return response($pricingRule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PricingRule  $pricingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PricingRule $pricingRule)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id|unique_with:pricing_rules,ad_id,' . $pricingRule->id,
            'ad_id' => 'required|exists:ads,id',
            'price' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'continuous' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        // Save pricing rule data
        $pricingRule->customer_id = $request->input('customer_id');
        $pricingRule->ad_id = $request->input('ad_id');
        $pricingRule->price = $request->input('price');
        $pricingRule->min_qty = $request->input('min_qty');
        $pricingRule->continuous = $request->input('continuous');
        $pricingRule->save();

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PricingRule  $pricingRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(PricingRule $pricingRule)
    {
        $pricingRule->delete();
        return response('', 200);
    }
}
