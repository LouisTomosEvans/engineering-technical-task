<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Property::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Property $property)
    {
        return $property;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new property
        $property = Property::create($request->all());
        return $property;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Update a property
        $property->update($request->all());
        return $property;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Delete a property
        $property->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }
}
