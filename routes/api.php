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

Route::resource('ad', 'AdController', ['except' => [
    'create', 'edit'
]]);

Route::resource('customer', 'CustomerController', ['except' => [
    'create', 'edit'
]]);

Route::resource('pricing-rule', 'PricingRuleController', ['except' => [
    'create', 'edit'
]]);
