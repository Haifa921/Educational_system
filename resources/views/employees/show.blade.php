@extends('layouts.master')
@section('title', 'تفاصيل الموظف')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل الموظف: {{ $employee->first_name }} {{ $employee->last_name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if($employee->personal_image)
                                <img src="{{ asset('storage/' . $employee->personal_image) }}" 
                                     alt="صورة الموظف" class="img-fluid rounded" style="max-height: 300px;">
                            @else
                                <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                     alt="صورة افتراضية" class="img-fluid rounded" style="max-height: 300px;">
                            @endif
                            <h4 class="mt-3">{{ $employee->first_name }} {{ $employee->last_name }}</h4>
                            <p class="text-muted">{{ $employee->Position->name ?? 'غير محدد' }}</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>المعلومات الشخصية</h5>
                                    <p><strong>الرقم الوطني:</strong> {{ $employee->national_number }}</p>
                                    <p><strong>الجنسية:</strong> {{ $employee->nationality ?? 'غير محدد' }}</p>
                                    <p><strong>تاريخ الميلاد:</strong> {{ $employee->birth_date }}</p>
                                    <p><strong>مكان الميلاد:</strong> {{ $employee->birth_place ?? 'غير محدد' }}</p>
                                    <p><strong>الجنس:</strong> {{ $employee->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>المعلومات الوظيفية</h5>
                                    <p><strong>المنطقة:</strong> {{ $employee->Region->name ?? 'غير محدد' }}</p>
                                    <p><strong>التخصص:</strong> {{ $employee->Major->name ?? 'غير محدد' }}</p>
                                    <p><strong>الحالة:</strong> 
                                        <span class="badge badge-{{ $employee->Status->color ?? 'secondary' }}">
                                            {{ $employee->Status->name ?? 'غير محدد' }}
                                        </span>
                                    </p>
                                    <p><strong>نوع التوفر:</strong> {{ $employee->Availability_type->name ?? 'غير محدد' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection