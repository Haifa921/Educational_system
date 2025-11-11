<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::with('city')
            ->withCount('employees')  // Add this line
            ->latest()
            ->paginate(10);
            
        return view('regions.index', compact('regions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('regions.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'city_id' => 'required|exists:city,id'
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'تم إضافة المنطقة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        $region->load('city', 'employees');
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $cities = City::all();
        return view('regions.edit', compact('region', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'city_id' => 'required|exists:city,id'
        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'تم تعديل المنطقة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('regions.index')
            ->with('success', 'تم حذف المنطقة بنجاح.');
    }
}