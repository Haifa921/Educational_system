<?php

namespace App\Http\Controllers;

use App\Models\Foreigner;
use App\Models\Employee;
use Illuminate\Http\Request;

class ForeignerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foreigners = Foreigner::with('Employee')->paginate(10);
        return view('foreigners.index', compact('foreigners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('foreigners.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'passport_number'        => 'required|string|max:50',
            'passport_release_date'  => 'nullable|date',
            'passport_valid_date'    => 'nullable|date',
            'security_approval_number'=> 'nullable|string|max:100',
            'security_approval_date'  => 'nullable|date',
            'security_approval_image' => 'nullable|image|max:2048',
            'work_approval_number'    => 'nullable|string|max:100',
            'work_approval_date'      => 'nullable|date',
            'work_approval_image'     => 'nullable|image|max:2048',
            'employee_id'             => 'nullable|exists:employees,id',
            'date_created'            => 'nullable|date',
            'date_modified)'           => 'nullable|date',
        ]);

        // Handle file uploads if images are provided
        foreach (['security_approval_image', 'work_approval_image'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('foreigner_images', 'public');
                $validated[$field] = $path;
            }
        }

        Foreigner::create($validated);

        return redirect()->route('foreigners.index')->with('success', 'تم اضافة الموظف بالاجنبي بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foreigner $foreigner)
    {
        $foreigner->load('Employee');
        return view('foreigners.show', compact('foreigner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foreigner $foreigner)
    {
        $employees = Employee::all();
        return view('foreigners.edit', compact('foreigner', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foreigner $foreigner)
    {
        $validated = $request->validate([
            'passport_number'        => 'required|string|max:50',
            'passport_release_date'  => 'nullable|date',
            'passport_valid_date'    => 'nullable|date',
            'security_approval_number'=> 'nullable|string|max:100',
            'security_approval_date'  => 'nullable|date',
            'security_approval_image' => 'nullable|image|max:2048',
            'work_approval_number'    => 'nullable|string|max:100',
            'work_approval_date'      => 'nullable|date',
            'work_approval_image'     => 'nullable|image|max:2048',
            'employee_id'             => 'nullable|exists:employees,id',
            'date_created'            => 'nullable|date',
            'date_modified)'           => 'nullable|date',
        ]);

        foreach (['security_approval_image', 'work_approval_image'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('foreigner_images', 'public');
                $validated[$field] = $path;
            }
        }

        $foreigner->update($validated);

        return redirect()->route('foreigners.index')->with('success', 'تم تعديل الموظف الاجنبي بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foreigner $foreigner)
    {
        $foreigner->delete();
        return redirect()->route('foreigners.index')->with('success', 'Foreigner deleted successfully.');
    }
}