@extends('layouts.master')
@section('title', 'تفاصيل حالة الموظف')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل حالة الموظف: {{ $employeeStatus->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>المعلومات الأساسية</h5>
                            <p><strong>اسم الحالة:</strong> {{ $employeeStatus->name }}</p>
                            <p><strong>عدد الموظفين:</strong> 
                                <span class="badge badge-info">{{ $employeeStatus->employees_count }}</span>
                            </p>
                            <p><strong>تاريخ الإنشاء:</strong> {{ $employeeStatus->date_careted ? $employeeStatus->date_careted : $employeeStatus->created_at->format('Y-m-d') }}</p>
                            <p><strong>تاريخ التعديل:</strong> {{ $employeeStatus->date_modified ? $employeeStatus->date_modified : $employeeStatus->updated_at->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    @if($employeeStatus->Employees->count() > 0)
                    <div class="mt-4">
                        <h5>الموظفون بهذه الحالة</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الموظف</th>
                                        <th>الرقم الوطني</th>
                                        <th>المسمى الوظيفي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employeeStatus->Employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td>{{ $employee->national_number }}</td>
                                        <td>{{ $employee->Position->name ?? 'غير محدد' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('employee-statuses.edit', $employeeStatus->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('employee-statuses.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection