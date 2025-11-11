<?php

namespace App\Http\Controllers;

use App\Models\Palastinians;
use App\Models\Employee;
use Illuminate\Http\Request;

class PalestiniansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $palestinians = Palastinians::with(['employee' => function($query) {
            $query->select('id', 'first_name', 'last_name'); // Only select needed columns
        }])->paginate(10);
        
        return view('palestinians.index', compact('palestinians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('palestinians.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'family_card_number' => 'required|string|max:255|unique:palestinians',
        'origin_place'       => 'required|string|max:255',
        'date_created'       => 'required|date',
        'date_modified)'      => 'required|date',
        'employee_id'        => 'nullable|exists:employees,id',
    ]);

    Palastinians::create($validated);

    return redirect()->route('palestinians.index')
        ->with('success', 'Palestinian record created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Palastinians $palestinian)
    {
        $palestinian->load(['employee']);
        return view('palestinians.show', compact('palestinian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Palastinians $palestinian)
    {
        $employees = Employee::all();
        return view('palestinians.edit', compact('palestinian', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Palastinians $palestinian)
    {
        $validated = $request->validate([
            'family_card_number' => 'required|string|max:255|unique:palestinians,family_card_number,' . $palestinian->id,
            'origin_place'       => 'required|string|max:255',
            'date_created'       => 'required|date',
            'date_modified)'     => 'required|date',  // Keep the parenthesis to match the field name
            'employee_id'        => 'nullable|exists:employees,id',
        ]);
    
        $palestinian->update($validated);
    
        return redirect()->route('palestinians.index')
            ->with('success', 'Palestinian record updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Palestinians $palestinian)
    {
        $palestinian->delete();

        return redirect()->route('palestinians.index')
            ->with('success', 'Palestinian record deleted successfully.');
    }
}