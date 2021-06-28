<?php

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;
use App\Http\Controllers\ClientController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/client', [ClientController::class, 'client']);
Route::get('/client', [ClientController::class, 'clients']);
Route::get('/client/{id}', [ClientController::class, 'client_id']);
Route::get('/client/find/{$query}', [ClientController::class, 'client_find']);




