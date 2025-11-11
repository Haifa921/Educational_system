<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::with(['faculty'])
            ->withCount('employees')
            ->latest()
            ->paginate(10);
            
        return view('majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('majors.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'faculty_id' => 'required|exists:faculty,id'
        ]);

        try {
            DB::beginTransaction();
            
            Major::create($request->all());
            
            DB::commit();
            
            return redirect()->route('majors.index')
                ->with('success', 'تم إضافة التخصص بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إضافة التخصص: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $major = Major::with(['faculty', 'employees'])->findOrFail($id);
        return view('majors.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $major = Major::findOrFail($id);
        $faculties = Faculty::all();
        return view('majors.edit', compact('major', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'faculty_id' => 'required|exists:faculty,id'
        ]);

        try {
            DB::beginTransaction();
            
            $major = Major::findOrFail($id);
            $major->update($request->all());
            
            DB::commit();
            
            return redirect()->route('majors.index')
                ->with('success', 'تم تحديث التخصص بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث التخصص: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $major = Major::findOrFail($id);
            
            // Check if major has employees
            if ($major->employees()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'لا يمكن حذف التخصص لأنه يحتوي على موظفين');
            }
            
            $major->delete();
            
            DB::commit();
            
            return redirect()->route('majors.index')
                ->with('success', 'تم حذف التخصص بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف التخصص: ' . $e->getMessage());
        }
    }
}