<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:customers|max:255',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        // Store new customer
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->save();

        return response(url('customers/' . $customer->id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:customers,name,' . $customer->id . '|max:255',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        // Save customer data
        $customer->name = $request->input('name');
        $customer->save();

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response('', 200);
    }
}