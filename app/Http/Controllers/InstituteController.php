<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if area_id is provided in the request
        $areaId = $request->input('area_id');
        $is_center = $request->input('is_center');
    
        // Retrieve institutes, filtering by area_id if provided
        $query = Institute::with('area');
    
        if ($areaId) {
            $query->where('area_id', $areaId);
        }

        if ($is_center) {
            $query->where('is_center', 1);
        }
    
        $institutes = $query->get();
    
        return response()->json($institutes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'is_active' => 'boolean',
            'is_center' => 'boolean',
        ]);

        // Create a new institute
        $institute = Institute::create($validatedData);

        return response()->json($institute, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the institute by ID
        $institute = Institute::findOrFail($id);

        return response()->json($institute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'phone' => 'string|max:255',
            'area_id' => 'exists:areas,id',
            'is_active' => 'boolean',
            'is_center' => 'boolean',
        ]);

        // Find the institute by ID and update it
        $institute = Institute::findOrFail($id);
        $institute->update($validatedData);

        return response()->json($institute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $institute = Institute::findOrFail($id);
        $institute->delete();

        return response()->json(null, 204);
    }
}
