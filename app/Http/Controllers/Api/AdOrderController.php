<?php

namespace App\Http\Controllers\Api;

use App\AdOrder;
use App\Http\Controllers\Controller;

class AdOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(AdOrder::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function show(AdOrder $order)
    {
        return response($order);
    }
}
