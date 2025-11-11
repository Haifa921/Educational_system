<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Employee;
use App\Models\Certificate_Type;
use App\Models\Certificate_Speciliazation;
use App\Models\Certificate_Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::with(['Employee', 'Certificate_Type', 'Certificate_Speciliazation', 'Certificate_Country'])
            ->latest()
            ->paginate(10);
        
        return view('certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $certificateTypes = Certificate_Type::all();
        $specializations = Certificate_Speciliazation::all();
        $countries = Certificate_Country::all();
        
        return view('certificates.create', compact('employees', 'certificateTypes', 'specializations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'certificate_type_id' => 'required|exists:certificate_type,id',
            'employee_id' => 'required|exists:employees,id',
            'specializaion_id' => 'required|exists:certificate_specialization,id',
            'country_id' => 'required|exists:certificate_country,id',
            'thesis_title' => 'nullable|string|max:500',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'release-date' => 'required|date', // تم تغيير release-date إلى release-date
            'description' => 'nullable|string',
            'company' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('certificate_file')) {
            $file = $request->file('certificate_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $data['certificate_file'] = $filePath;
        }

        $data['date_created'] = now();
        $data['date_modified'] = now();

        // تأكد من وجود قيمة ل release-date
        if (empty($data['release-date'])) {
            $data['release-date'] = now()->format('Y-m-d');
        }

        Certificate::create($data);

        return redirect()->route('certificates.index')
            ->with('success', 'تم إضافة الشهادة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        $certificate->load(['employee', 'certificate_type', 'certificate_speciliazation', 'certificate_country']);
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $certificateTypes = Certificate_Type::all();
        $specializations = Certificate_Speciliazation::all();
        $countries = Certificate_Country::all();
        
        return view('certificates.edit', compact('certificate', 'employees', 'certificateTypes', 'specializations', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'certificate_type_id' => 'required|exists:certificate_type,id',
            'employee_id' => 'required|exists:employees,id',
            'specializaion_id' => 'required|exists:certificate_specialization,id',
            'country_id' => 'required|exists:certificate_country,id',
            'thesis_title' => 'nullable|string|max:500',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'release-date' => 'required|date', // تم تغيير release-date إلى release-date
            'description' => 'nullable|string',
            'company' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('certificate_file')) {
            // Delete old file if exists
            if ($certificate->certificate_file) {
                Storage::disk('public')->delete($certificate->certificate_file);
            }
            
            $file = $request->file('certificate_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $data['certificate_file'] = $filePath;
        }

        $data['date_modified'] = now();

        $certificate->update($data);

        return redirect()->route('certificates.index')
            ->with('success', 'تم تحديث الشهادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        // Delete associated file
        if ($certificate->certificate_file) {
            Storage::disk('public')->delete($certificate->certificate_file);
        }

        $certificate->delete();

        return redirect()->route('certificates.index')
            ->with('success', 'تم حذف الشهادة بنجاح');
    }

    /**
     * Download certificate file
     */
    public function download(Certificate $certificate)
    {
        if (!$certificate->certificate_file) {
            return back()->with('error', 'لا يوجد ملف مرفق');
        }

        return Storage::disk('public')->download($certificate->certificate_file);
    }
}