<?php

namespace App\Http\Controllers;

use App\Models\Life_Event;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Http\Request;

class LifeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lifeEvents = Life_Event::with(['employee', 'event'])
            ->latest()
            ->paginate(10);
            
        return view('life_events.index', compact('lifeEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $events = Event::all();
        return view('life_events.create', compact('employees', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'event_id' => 'required|exists:events,id',
            'description' => 'required|string',
            'note' => 'nullable|string',
        ]);

        Life_Event::create($validated);

        return redirect()->route('life_events.index')
            ->with('success', 'Life Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Life_Event $lifeEvent)
    {
        $lifeEvent->load(['employee', 'event']);
        return view('life_events.show', compact('lifeEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Life_Event $lifeEvent)
    {
        $employees = Employee::all();
        $events = Event::all();
        return view('life_events.edit', compact('lifeEvent', 'employees', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Life_Event $lifeEvent)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'event_id' => 'required|exists:events,id',
            'description' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $lifeEvent->update($validated);

        return redirect()->route('life_events.index')
            ->with('success', 'Life Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Life_Event $lifeEvent)
    {
        $lifeEvent->delete();

        return redirect()->route('life_events.index')
            ->with('success', 'Life Event deleted successfully.');
    }
}