<?php

use App\Http\Controllers\API\TestAPIController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Routes for Test Model
Route::prefix('test')->group(function () {
    Route::get('/', [TestAPIController::class, 'index']);
    Route::post('/create', [TestAPIController::class, 'store']);
});
