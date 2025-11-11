<?php

namespace App\Http\Controllers;

use App\Models\Certificate_Country;
use Illuminate\Http\Request;

class CertificateCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Certificate_Country::latest()->paginate(10);
        return view('certificate-countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificate-countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_country',
            'note' => 'nullable|string|max:500',
        ]);

        Certificate_Country::create($request->all());

        return redirect()->route('certificate-countries.index')
            ->with('success', 'تم إضافة بلد الشهادة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate_Country $certificateCountry)
    {
        return view('certificate-countries.show', compact('certificateCountry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate_Country $certificateCountry)
    {
        return view('certificate-countries.edit', compact('certificateCountry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate_Country $certificateCountry)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_country,name,' . $certificateCountry->id,
            'note' => 'nullable|string|max:500',
        ]);

        $certificateCountry->update($request->all());

        return redirect()->route('certificate-countries.index')
            ->with('success', 'تم تحديث بلد الشهادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate_Country $certificateCountry)
    {
        $certificateCountry->delete();

        return redirect()->route('certificate-countries.index')
            ->with('success', 'تم حذف بلد الشهادة بنجاح');
    }
}