<?php

namespace App\Http\Controllers;

use App\Models\Taught_Course;
use App\Models\Employee;
use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaughtCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taughtCourses = Taught_Course::with(['employee', 'course', 'university'])
            ->latest()
            ->paginate(10);
        
        return view('taught-courses.index', compact('taughtCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $courses = Course::all();
        $universities = University::all();
        
        return view('taught-courses.create', compact('employees', 'courses', 'universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'course_id' => 'required|exists:courses,id',
            'university_id' => 'required|exists:universities,id',
            'note' => 'nullable|string|max:500',
        ]);

        // استخدام الطريقة الآمنة لتعيين القيم مع الحقل date_modified)
        $taughtCourse = new Taught_Course();
        $taughtCourse->employee_id = $request->employee_id;
        $taughtCourse->course_id = $request->course_id;
        $taughtCourse->university_id = $request->university_id;
        $taughtCourse->note = $request->note;
        $taughtCourse->date_created = Carbon::now();
        $taughtCourse->{'date_modified)'} = Carbon::now(); // استخدام الحقل بالقوس
        $taughtCourse->save();

        return redirect()->route('taught-courses.index')
            ->with('success', 'تم إضافة المقرر المدّرس بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Taught_Course $taughtCourse)
    {
        $taughtCourse->load(['employee', 'course', 'university']);
        return view('taught-courses.show', compact('taughtCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Taught_Course $taughtCourse)
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $courses = Course::all();
        $universities = University::all();
        
        return view('taught-courses.edit', compact('taughtCourse', 'employees', 'courses', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Taught_Course $taughtCourse)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'course_id' => 'required|exists:courses,id',
            'university_id' => 'required|exists:universities,id',
            'note' => 'nullable|string|max:500',
        ]);

        $taughtCourse->employee_id = $request->employee_id;
        $taughtCourse->course_id = $request->course_id;
        $taughtCourse->university_id = $request->university_id;
        $taughtCourse->note = $request->note;
        $taughtCourse->{'date_modified)'} = Carbon::now(); // استخدام الحقل بالقوس
        $taughtCourse->save();

        return redirect()->route('taught-courses.index')
            ->with('success', 'تم تحديث المقرر المدّرس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taught_Course $taughtCourse)
    {
        $taughtCourse->delete();

        return redirect()->route('taught-courses.index')
            ->with('success', 'تم حذف المقرر المدّرس بنجاح');
    }
}