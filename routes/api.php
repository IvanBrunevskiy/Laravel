<?php

use App\Http\Controllers\Api\SearchController;
use App\Mail\OrderCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
Route::get('mail', function (){
  Mail::to('ivan@gmail.com')->send(new OrderCompleted('Hi everyone!!! Bratan'));
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
