<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/api/properties', 'PropertyController@index');

// Get a single property
Route::get('/api/properties/{id}', 'PropertyController@show');


// ** PROTECTED ROUTES **
// Create a new property
Route::post('/api/properties', 'PropertyController@store')->middleware('auth:sanctum');

// Update a property
Route::put('/api/properties/{property}', 'PropertyController@update')->middleware('auth:sanctum');

// Delete a property
Route::delete('/api/properties/{property}', 'PropertyController@destroy')->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| Room routes
|--------------------------------------------------------------------------
*/

// ** PUBLIC ROUTES **
// Get all rooms
Route::get('/api/rooms', 'RoomController@index');

// Get all rooms for a specific property
Route::get('/api/rooms/{property}', 'RoomController@getByProperty');

// ** PROTECTED ROUTES **
// Create a new room
Route::post('/api/rooms', 'RoomController@store')->middleware('auth:sanctum');

// Update a room
Route::put('/api/rooms/{room}', 'RoomController@update')->middleware('auth:sanctum');

// Delete a room
Route::delete('/api/rooms/{room}', 'RoomController@destroy')->middleware('auth:sanctum');
