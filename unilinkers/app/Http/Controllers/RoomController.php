<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Property;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Room::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getByProperty(Property $property)
    {
        return $property->rooms;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Create a new room
        $room = Room::create($request->all());
        return $room;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        // Update a room
        $room->update($request->all());
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Delete a room
        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
