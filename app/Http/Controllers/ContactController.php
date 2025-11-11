<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Employee;
use App\Models\Contact_Type;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with(['Employee', 'Contact_Type'])
            ->latest()
            ->paginate(10);
            
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $contactTypes = Contact_Type::all();
        return view('contacts.create', compact('employees', 'contactTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'contact_type_id' => 'required|exists:contact_type,id',
            'contact_value' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        Contact::create($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'تم إنشاء جهة الاتصال.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load(['employee', 'contact_type']);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $employees = Employee::all();
        $contactTypes = Contact_Type::all();
        return view('contacts.edit', compact('contact', 'employees', 'contactTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'contact_type_id' => 'required|exists:contact_type,id',
            'contact_value' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'تم تعديل جهة الاتصال.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'تم حذف جهة الاتصال.');
    }
}