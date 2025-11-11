<?php

namespace App\Http\Controllers;

use App\Models\Iust_Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IustCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iustCourses = Iust_Course::withCount('iust_course_intitled')
            ->latest()
            ->paginate(10);
        return view('iust-courses.index', compact('iustCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('iust-courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:iust_courses',
            'note' => 'nullable|string|max:500',
        ]);

        // استخدام Carbon لتحديد الوقت الحالي
        $iustCourse = new Iust_Course();
        $iustCourse->name = $request->name;
        $iustCourse->note = $request->note;
        $iustCourse->date_created = Carbon::now();
        $iustCourse->{'date_modified)'} = Carbon::now();
        $iustCourse->save();

        return redirect()->route('iust-courses.index')
            ->with('success', 'تم إضافة مقرر الجامعة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Iust_Course $iustCourse)
    {
        // تحميل العلاقات إذا كنت تريد عرضها
        $iustCourse->load('iust_course_intitled.employee');
        return view('iust-courses.show', compact('iustCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iust_Course $iustCourse)
    {
        return view('iust-courses.edit', compact('iustCourse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Iust_Course $iustCourse)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:iust_courses,name,' . $iustCourse->id,
            'note' => 'nullable|string|max:500',
        ]);

        $iustCourse->name = $request->name;
        $iustCourse->note = $request->note;
        $iustCourse->{'date_modified)'} = Carbon::now();
        $iustCourse->save();

        return redirect()->route('iust-courses.index')
            ->with('success', 'تم تحديث مقرر الجامعة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iust_Course $iustCourse)
    {
        $iustCourse->delete();

        return redirect()->route('iust-courses.index')
            ->with('success', 'تم حذف مقرر الجامعة بنجاح');
    }
}