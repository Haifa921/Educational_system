@extends('layouts.master')
@section('title', 'تفاصيل المسمى الوظيفي')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المسمى الوظيفي: {{ $position->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>المعلومات الأساسية</h5>
                            <p><strong>اسم المسمى الوظيفي:</strong> {{ $position->name }}</p>
                            <p><strong>عدد الموظفين:</strong> 
                                <span class="badge badge-info">{{ $position->employees_count }}</span>
                            </p>
                            <p><strong>تاريخ الإضافة:</strong> {{ $position->created_at->format('Y-m-d') }}</p>
                            <p><strong>آخر تحديث:</strong> {{ $position->updated_at->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>الملاحظات</h5>
                            <p>{{ $position->note ?? 'لا توجد ملاحظات' }}</p>
                        </div>
                    </div>

                    @if($position->Employees->count() > 0)
                    <div class="mt-4">
                        <h5>الموظفون بهذا المسمى الوظيفي</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الموظف</th>
                                        <th>الرقم الوطني</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($position->Employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td>{{ $employee->national_number }}</td>
                                        <td>
                                            <span class="badge badge-{{ $employee->Status->color ?? 'secondary' }}">
                                                {{ $employee->Status->name ?? 'غير محدد' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection