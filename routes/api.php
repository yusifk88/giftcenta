<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/bills',"BillsController@index");
Route::post('/newcard','VirtualCardController@store');
Route::get('/card/{id}','VirtualCardController@show');
Route::get('sendcard/{id}','VirtualCardController@send');
Route::get('airtime/{id}','BillsController@show');
Route::post('buyairtime','BillsController@buyairtime');
