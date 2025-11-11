<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::withCount('Employees')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:position', // Change to 'position'
            'note' => 'nullable|string|max:1000',
        ]);
        

        Position::create($request->all());

        return redirect()->route('positions.index')
                        ->with('success', 'تم إضافة المسمى الوظيفي بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        $position->load('Employees');
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:position,name,' . $position->id, // Change to 'position'
            'note' => 'nullable|string|max:1000',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
                        ->with('success', 'تم تحديث المسمى الوظيفي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        // Check if position has employees
        if ($position->Employees()->count() > 0) {
            return redirect()->route('positions.index')
                            ->with('error', 'لا يمكن حذف المسمى الوظيفي لأنه مرتبط بموظفين');
        }

        $position->delete();

        return redirect()->route('positions.index')
                        ->with('success', 'تم حذف المسمى الوظيفي بنجاح');
    }
}