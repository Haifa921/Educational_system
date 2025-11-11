@extends('layouts.master')
@section('title', 'تفاصيل نوع التوفر')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل نوع التوفر: {{ $availabilityType->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>المعلومات الأساسية</h5>
                            <p><strong>اسم نوع التوفر:</strong> {{ $availabilityType->name }}</p>
                            <p><strong>عدد الساعات:</strong> 
                                <span class="badge badge-info">{{ $availabilityType->hours_count }} ساعة</span>
                            </p>
                            <p><strong>عدد الموظفين:</strong> 
                                <span class="badge badge-primary">{{ $availabilityType->employees_count }}</span>
                            </p>
                            <p><strong>تاريخ الإنشاء:</strong> {{ $availabilityType->date_created ? $availabilityType->date_created : $availabilityType->created_at->format('Y-m-d') }}</p>
                            <p><strong>تاريخ التعديل:</strong> {{ $availabilityType->date_modified ? $availabilityType->date_modified : $availabilityType->updated_at->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    @if($availabilityType->Employees->count() > 0)
                    <div class="mt-4">
                        <h5>الموظفون بهذا النوع من التوفر</h5>
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
                                    @foreach($availabilityType->Employees as $employee)
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
                        <a href="{{ route('availability-types.edit', $availabilityType->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('availability-types.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection