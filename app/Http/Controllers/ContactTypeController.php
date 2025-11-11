<?php

namespace App\Http\Controllers;

use App\Models\Contact_Type;
use Illuminate\Http\Request;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactTypes = Contact_Type::withCount('Contact')
            ->latest()
            ->paginate(10);
           
        return view('contact_types.index', compact('contactTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_value' => 'required|string|max:255|unique:contact_type',
            'note' => 'nullable|string',
        ]);

        Contact_Type::create($validated);

        return redirect()->route('contact-types.index')
            ->with('success', 'تم إنشاء نوع جهة الاتصال.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact_Type $contactType)
    {
        $contactType->load(['contact']);
        $contactsCount = $contactType->contact ? $contactType->contact->count() : 0;
        return view('contact_types.show', compact('contactType','contactsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact_Type $contactType)
    {
        return view('contact_types.edit', compact('contactType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact_Type $contactType)
    {
        $validated = $request->validate([
            'type_value' => 'required|string|max:255|unique:contact_type,type_value,' . $contactType->id,
            'note' => 'nullable|string',
        ]);

        $contactType->update($validated);

        return redirect()->route('contact-types.index')
            ->with('success', 'تم تعديل نوع جهة الاتصال.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact_Type $contactType)
    {
        // Check if contact type has contacts
        if ($contactType->contacts()->count() > 0) {
            return redirect()->route('contact-types.index')
                ->with('error', 'Cannot delete contact type because it has associated contacts.');
        }

        $contactType->delete();

        return redirect()->route('contact-types.index')
            ->with('success', 'تم حذف نوع جهة الاتصال.');
    }
}