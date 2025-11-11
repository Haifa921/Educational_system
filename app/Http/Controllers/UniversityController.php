<?php
// app/Http/Controllers/UniversityController.php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::latest('date_modified)')->paginate(10);
        return view('universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:universities',
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ], [
            'name.required' => 'اسم الجامعة مطلوب',
            'name.unique' => 'هذه الجامعة موجودة مسبقاً',
            'date_created.date' => 'تاريخ الإنشاء يجب أن يكون تاريخ صحيح',
            'date_modified).date' => 'تاريخ التعديل يجب أن يكون تاريخ صحيح',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        University::create([
            'name' => $request->name,
            'date_created' => $request->date_created ? Carbon::parse($request->date_created) : Carbon::now(),
            'date_modified)' => $request->date_modified ? Carbon::parse($request->date_modified) : Carbon::now(),
        ]);

        return redirect()->route('universities.index')
            ->with('success', 'تم إضافة الجامعة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:universities,name,' . $university->id,
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ], [
            'name.required' => 'اسم الجامعة مطلوب',
            'name.unique' => 'هذه الجامعة موجودة مسبقاً',
            'date_created.date' => 'تاريخ الإنشاء يجب أن يكون تاريخ صحيح',
            'date_modified).date' => 'تاريخ التعديل يجب أن يكون تاريخ صحيح',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $university->update([
            'name' => $request->name,
            'date_created' => $request->date_created ? Carbon::parse($request->date_created) : $university->date_created,
            'date_modified)' => $request->date_modified ? Carbon::parse($request->date_modified) : Carbon::now(),
        ]);

        return redirect()->route('universities.index')
            ->with('success', 'تم تحديث الجامعة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();

        return redirect()->route('universities.index')
            ->with('success', 'تم حذف الجامعة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }
}