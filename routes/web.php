<?php

use App\Http\Controllers\BillsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BillsController@home');

Route::get('bills',"BillsController@index");
Route::get('buycard/{id}',"VirtualCardController@buycard");
Route::get('sendairtime/{id}',"BillsController@payairtime");

Route::get('testmail','BillsController@mail');
