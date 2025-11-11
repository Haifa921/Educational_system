<?php

namespace App\Http\Controllers;

use App\Models\Certificate_Speciliazation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CertificateSpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Certificate_Speciliazation::orderBy('date_modified)', 'desc')->paginate(10);
        return view('certificate-specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificate-specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_specialization',
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ]);

        // استخدام القيم المقدمة أو التاريخ الحالي
        $dateCreated = $request->date_created ? Carbon::parse($request->date_created) : Carbon::now();
        $dateModified = $request->date_modified ? Carbon::parse($request->date_modified) : Carbon::now();

        Certificate_Speciliazation::create([
            'name' => $request->name,
            'date_created' => $dateCreated,
            'date_modified)' => $dateModified,
        ]);

        return redirect()->route('certificate-specializations.index')
            ->with('success', 'تم إضافة التخصص بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate_Speciliazation $certificateSpecialization)
    {
        return view('certificate-specializations.show', compact('certificateSpecialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate_Speciliazation $certificateSpecialization)
    {
        return view('certificate-specializations.edit', compact('certificateSpecialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate_Speciliazation $certificateSpecialization)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:certificate_specialization,name,' . $certificateSpecialization->id,
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ]);

        // استخدام القيم المقدمة أو الاحتفاظ بالقيم الحالية
        $dateCreated = $request->date_created ? Carbon::parse($request->date_created) : $certificateSpecialization->date_created;
        $dateModified = $request->date_modified ? Carbon::parse($request->date_modified) : Carbon::now();

        $certificateSpecialization->update([
            'name' => $request->name,
            'date_created' => $dateCreated,
            'date_modified)' => $dateModified,
        ]);

        return redirect()->route('certificate-specializations.index')
            ->with('success', 'تم تحديث التخصص بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate_Speciliazation $certificateSpecialization)
    {
        $certificateSpecialization->delete();

        return redirect()->route('certificate-specializations.index')
            ->with('success', 'تم حذف التخصص بنجاح');
    }
}