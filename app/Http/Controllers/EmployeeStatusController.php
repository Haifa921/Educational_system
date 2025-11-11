<?php

namespace App\Http\Controllers;

use App\Models\Employee_Statu;
use Illuminate\Http\Request;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeStatuses = Employee_Statu::withCount('Employees')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);
        
        return view('employee_statuses.index', compact('employeeStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employee_status',
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ]);

        Employee_Statu::create($request->all());

        return redirect()->route('employee-statuses.index')
                        ->with('success', 'تم إضافة حالة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee_Statu $employeeStatus)
    {
        $employeeStatus->load('Employees');
        return view('employee_statuses.show', compact('employeeStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee_Statu $employeeStatus)
    {
        return view('employee_statuses.edit', compact('employeeStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee_Statu $employeeStatus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employee_status,name,' . $employeeStatus->id,
            'date_created' => 'nullable|date',
            'date_modified)' => 'nullable|date',
        ]);

        $employeeStatus->update($request->all());

        return redirect()->route('employee-statuses.index')
                        ->with('success', 'تم تحديث حالة الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee_Statu $employeeStatus)
    {
        // Check if employee status has employees
        if ($employeeStatus->Employees()->count() > 0) {
            return redirect()->route('employee-statuses.index')
                            ->with('error', 'لا يمكن حذف حالة الموظف لأنها مرتبطة بموظفين');
        }

        $employeeStatus->delete();

        return redirect()->route('employee-statuses.index')
                        ->with('success', 'تم حذف حالة الموظف بنجاح');
    }
}