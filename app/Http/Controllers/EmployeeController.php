<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Region;
use App\Models\Major;
use App\Models\Employee_Statu;
use App\Models\Availability_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**شرش
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['Position', 'Region', 'Major', 'Status'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $regions = Region::all();
        $majors = Major::all();
        $statuses = Employee_Statu::all();
       // $availabilityTypes = Availability_type::all();
        
        return view('employees.create', compact('positions', 'regions', 'majors', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_number' => 'required|unique:employees|max:20',
            'birth_date' => 'required|date',
            'scientific_rank' => 'required|string|max:255', 
            'general_specialization' => 'required|string|max:255', 
            'detailed_specialization' => 'required|string|max:255', 
            'personal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scientific_rank_obtaining_date' => 'required|date',
            'affiliated_government_agency' => 'nullable|string|max:255',
            'is_contracted' => 'sometimes|boolean',
            'availability_days_count' => 'nullable|numeric|min:0|max:365',
            'availability_hours_count' => 'nullable|numeric|min:0|max:365',
            'gender' => 'required|in:male,female',
            'position_id' => 'required|exists:position,id',
            'region_id' => 'required|exists:region,id',
            'major_id' => 'required|exists:major,id',
            'status_id' => 'required|exists:employee_status,id',
            //'availability_id' => 'required|exists:availability_types,id',
        ]);

        $data = $request->all();
        $data['is_contracted'] = $request->has('is_contracted') ? true : false;
        $data['availability_days_count'] = $request->filled('availability_days_count') 
        ? (float) $request->input('availability_days_count') 
        : null;
       // $data['scientific_rank_obtaining_date'] = $data['scientific_rank_obtaining_date'] ?? null;
        // Handle personal image upload
        if ($request->hasFile('personal_image')) {
            $data['personal_image'] = $request->file('personal_image')->store('employees/personal_images', 'public');
        }

        // Handle ID image upload
        if ($request->hasFile('id_image')) {
            $data['id_image'] = $request->file('id_image')->store('employees/id_images', 'public');
        }

        Employee::create($data);

        return redirect()->route('employees.index')
                        ->with('success', 'تم إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load([
            'Position', 
            'Region', 
            'Major', 
            'Status', 
            'Availability_type',
            'life_event',
            'Contact',
            'Certificate'
        ]);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all();
        $regions = Region::all();
        $majors = Major::all();
        $statuses = Employee_Statu::all();
       // $availabilityTypes = Availability_type::all();
        
        return view('employees.edit', compact('employee', 'positions', 'regions', 'majors', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
         $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_number' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'scientific_rank' => 'required|string|max:255', 
            'general_specialization' => 'required|string|max:255', 
            'detailed_specialization' => 'required|string|max:255', 
            'personal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scientific_rank_obtaining_date' => 'required|date',
            'affiliated_government_agency' => 'nullable|string|max:255',
            'is_contracted' => 'sometimes|boolean',
            'availability_days_count' => 'nullable|numeric|min:0|max:365',
            'availability_hours_count' => 'nullable|numeric|min:0|max:365',
            'gender' => 'required|in:male,female',
            'position_id' => 'required|exists:position,id',
            'region_id' => 'required|exists:region,id',
            'major_id' => 'required|exists:major,id',
            'status_id' => 'required|exists:employee_status,id',
           // 'availability_id' => 'required|exists:availability_types,id',
        ]);

        $data = $request->all();
        $data['is_contracted'] = $request->has('is_contracted') ? true : false;
        $data['availability_days_count'] = $request->filled('availability_days_count') 
        ? (float) $request->input('availability_days_count') 
        : null;
        // Handle personal image upload
        if ($request->hasFile('personal_image')) {
            // Delete old image if exists
            if ($employee->personal_image) {
                Storage::disk('public')->delete($employee->personal_image);
            }
            $data['personal_image'] = $request->file('personal_image')->store('employees/personal_images', 'public');
        }

        // Handle ID image upload
        if ($request->hasFile('id_image')) {
            // Delete old image if exists
            if ($employee->id_image) {
                Storage::disk('public')->delete($employee->id_image);
            }
            $data['id_image'] = $request->file('id_image')->store('employees/id_images', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')
                        ->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Delete images if they exist
        if ($employee->personal_image) {
            Storage::disk('public')->delete($employee->personal_image);
        }
        if ($employee->id_image) {
            Storage::disk('public')->delete($employee->id_image);
        }

        $employee->delete();

        return redirect()->route('employees.index')
                        ->with('success', 'تم حذف الموظف بنجاح');
    }
}