<?php

namespace App\Http\Controllers;

use App\Models\Iust_Course_Intitled;
use App\Models\Employee;
use App\Models\Iust_Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IustCourseIntitledController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursesIntitled = Iust_Course_Intitled::with(['employee', 'iust_course'])
            ->latest()
            ->paginate(10);
        
        return view('iust-courses-intitled.index', compact('coursesIntitled'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $iustCourses = Iust_Course::all();
        
        return view('iust-courses-intitled.create', compact('employees', 'iustCourses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'iust_course_id' => 'required|exists:iust_courses,id',
            'ministerial_resolution_number' => 'required|string|max:255',
            'being_taught_now' => 'required|boolean',
            'note' => 'nullable|string|max:500',
        ]);

        // استخدام الطريقة الآمنة لتعيين القيم مع الحقل date_modified))
        $courseIntitled = new Iust_Course_Intitled();
        $courseIntitled->employee_id = $request->employee_id;
        $courseIntitled->iust_course_id = $request->iust_course_id;
        $courseIntitled->ministerial_resolution_number = $request->ministerial_resolution_number;
        $courseIntitled->being_taught_now = $request->being_taught_now;
        $courseIntitled->note = $request->note;
        $courseIntitled->date_created = Carbon::now();
        $courseIntitled->{'date_modified)'} = Carbon::now(); // استخدام الحقل بالقوس
        $courseIntitled->save();

        return redirect()->route('iust-courses-intitled.index')
            ->with('success', 'تم إضافة صلاحية تدريس المقرر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Iust_Course_Intitled $iustCourseIntitled)
    {
        $iustCourseIntitled->load(['employee', 'iust_course']);
        return view('iust-courses-intitled.show', compact('iustCourseIntitled'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iust_Course_Intitled $iustCourseIntitled)
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $iustCourses = Iust_Course::all();
        
        return view('iust-courses-intitled.edit', compact('iustCourseIntitled', 'employees', 'iustCourses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Iust_Course_Intitled $iustCourseIntitled)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'iust_course_id' => 'required|exists:iust_courses,id',
            'ministerial_resolution_number' => 'required|string|max:255',
            'being_taught_now' => 'required|boolean',
            'note' => 'nullable|string|max:500',
        ]);

        $iustCourseIntitled->employee_id = $request->employee_id;
        $iustCourseIntitled->iust_course_id = $request->iust_course_id;
        $iustCourseIntitled->ministerial_resolution_number = $request->ministerial_resolution_number;
        $iustCourseIntitled->being_taught_now = $request->being_taught_now;
        $iustCourseIntitled->note = $request->note;
        $iustCourseIntitled->{'date_modified)'} = Carbon::now(); // استخدام الحقل بالقوس
        $iustCourseIntitled->save();

        return redirect()->route('iust-courses-intitled.index')
            ->with('success', 'تم تحديث صلاحية تدريس المقرر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iust_Course_Intitled $iustCourseIntitled)
    {
        $iustCourseIntitled->delete();

        return redirect()->route('iust-courses-intitled.index')
            ->with('success', 'تم حذف صلاحية تدريس المقرر بنجاح');
    }
}