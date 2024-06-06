<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Property routes
|--------------------------------------------------------------------------
*/

// ** PUBLIC ROUTES **

// Get all properties
Route::get('/properties', [PropertyController::class, 'index']);

// Get a single property
Route::get('/properties/{id}', [PropertyController::class, 'show']);


// ** PROTECTED ROUTES **
// Create a new property
Route::post('/properties', [PropertyController::class, 'store']);

// Update a property
Route::put('/properties/{property}', [PropertyController::class, 'update']);

// Delete a property
Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Room routes
|--------------------------------------------------------------------------
*/

// ** PUBLIC ROUTES **
// Get all rooms
Route::get('/rooms', [RoomController::class, 'index']);

// Get all rooms for a specific property
Route::get('/rooms/{property}', [RoomController::class, 'getByProperty']);

// ** PROTECTED ROUTES **
// Create a new room
Route::post('/rooms', [RoomController::class, 'store']);

// Update a room
Route::put('/rooms/{room}', [RoomController::class, 'update']);

// Delete a room
Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
*/

// Check if user is logged in - for route authentication
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
