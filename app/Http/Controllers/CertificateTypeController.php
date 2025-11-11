<?php

namespace App\Http\Controllers;

use App\Models\Certificate_Type;
use Illuminate\Http\Request;

class CertificateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificateTypes = Certificate_Type::latest()->paginate(10);
        return view('certificate-types.index', compact('certificateTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificate-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_type',
            'note' => 'nullable|string|max:500',
        ]);

        Certificate_Type::create($request->all());

        return redirect()->route('certificate-types.index')
            ->with('success', 'تم إضافة نوع الشهادة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate_Type $certificateType)
    {
        return view('certificate-types.show', compact('certificateType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate_Type $certificateType)
    {
        return view('certificate-types.edit', compact('certificateType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate_Type $certificateType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_type,name,' . $certificateType->id,
            'note' => 'nullable|string|max:500',
        ]);

        $certificateType->update($request->all());

        return redirect()->route('certificate-types.index')
            ->with('success', 'تم تحديث نوع الشهادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate_Type $certificateType)
    {
        $certificateType->delete();

        return redirect()->route('certificate-types.index')
            ->with('success', 'تم حذف نوع الشهادة بنجاح');
    }
}