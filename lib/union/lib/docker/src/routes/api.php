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

Route::get('/testing-the-api', function(){
    $var = \Illuminate\Support\Facades\DB::connection('mysql_network')
        ->table('security_auth-general_account_profiles')
        ->take(1)
        ->get();
    return ['message' => $var];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
