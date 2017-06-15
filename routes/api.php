<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('ads', 'Api\AdController', ['only' => [
    'index', 'show'
]]);

Route::resource('ad-orders', 'Api\AdOrderController', ['only' => [
    'index', 'show'
]]);

Route::resource('customers', 'Api\CustomerController', ['except' => [
    'create', 'edit'
]]);

Route::resource('pricing-rules', 'Api\PricingRuleController', ['except' => [
    'create', 'edit'
]]);

Route::resource('checkout', 'Api\CheckoutController', ['only' => [
    'store'
]]);
