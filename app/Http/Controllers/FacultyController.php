<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $faculties = Faculty::withCount('majors')  // Change from 'Major' to 'majors'
        ->latest()
        ->paginate(10);
        
    return view('faculties.index', compact('faculties'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:faculty,name',
            'note' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            Faculty::create($request->all());
            
            DB::commit();
            
            return redirect()->route('faculties.index')
                ->with('success', 'تم إضافة الكلية بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إضافة الكلية: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $faculty = Faculty::with(['Major'])->findOrFail($id);
        return view('faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:faculty,name,' . $id,
            'note' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            $faculty = Faculty::findOrFail($id);
            $faculty->update($request->all());
            
            DB::commit();
            
            return redirect()->route('faculties.index')
                ->with('success', 'تم تحديث الكلية بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث الكلية: ' . $e->getMessage())
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
            
            $faculty = Faculty::findOrFail($id);
            
            // Check if faculty has majors
            if ($faculty->Major()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'لا يمكن حذف الكلية لأنها تحتوي على تخصصات');
            }
            
            $faculty->delete();
            
            DB::commit();
            
            return redirect()->route('faculties.index')
                ->with('success', 'تم حذف الكلية بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف الكلية: ' . $e->getMessage());
        }
    }
}