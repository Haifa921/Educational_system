<?php

namespace App\Http\Controllers;

use App\Models\Availability_type;
use Illuminate\Http\Request;

class AvailabilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $availabilityTypes = Availability_type::withCount('Employees')
                                            ->orderBy('created_at', 'desc')
                                            ->paginate(10);
        
        return view('availability_types.index', compact('availabilityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('availability_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:availability_type',
            'hours_count' => 'required|integer|min:0',
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ]);
    
        Availability_type::create([
            'name' => $validated['name'],
            'hours_count' => $validated['hours_count'],
            'date_created' => $validated['date_created'],
            'date_modified)' => $validated['date_modified)'],
        ]);

        return redirect()->route('availability-types.index')
                        ->with('success', 'تم إضافة نوع التوفر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Availability_type $availabilityType)
    {
        $availabilityType->load('Employees');
        return view('availability_types.show', compact('availabilityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Availability_type $availabilityType)
    {
        return view('availability_types.edit', compact('availabilityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Availability_type $availabilityType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:availability_type,name,' . $availabilityType->id,
            'hours_count' => 'required|integer|min:0',
            'date_created' => 'nullable|date',
            '[date_modified)]' => 'nullable|date',
        ]);
        $availabilityType->update([
            'name' => $validated['name'],
            'hours_count' => $validated['hours_count'],
            'date_created' => $validated['date_created'],
            'date_modified)' => $validated['date_modified)'],
        ]);

        return redirect()->route('availability-types.index')
                        ->with('success', 'تم تحديث نوع التوفر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Availability_type $availabilityType)
    {
        // Check if availability type has employees
        if ($availabilityType->Employees()->count() > 0) {
            return redirect()->route('availability-types.index')
                            ->with('error', 'لا يمكن حذف نوع التوفر لأنه مرتبط بموظفين');
        }

        $availabilityType->delete();

        return redirect()->route('availability-types.index')
                        ->with('success', 'تم حذف نوع التوفر بنجاح');
    }
}