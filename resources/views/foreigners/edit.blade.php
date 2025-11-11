@extends('layouts.master')
@section('title', 'تعديل موظف اجنبي')

@section('content')
<hr>
<h1>تعديل موظف</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('foreigners.update', $foreigner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>رقم جواز السفر</label>
        <input type="text" name="passport_number" class="form-control" value="{{ old('passport_number', $foreigner->passport_number) }}" required>
    </div>

    <div class="mb-3">
        <label>تاريخ منح الجواز</label>
        <input type="date" name="passport_release_date" class="form-control" value="{{ old('passport_release_date', $foreigner->passport_release_date) }}">
    </div>

    <div class="mb-3">
        <label>تاريخ صلاحية الجواز *</label>
        <input type="date" name="passport_valid_date" class="form-control" 
               value="{{ old('passport_valid_date', $foreigner->passport_valid_date) }}" required>
        @error('passport_valid_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>رقم الموافقة الامنية</label>
        <input type="text" name="security_approval_number" class="form-control" value="{{ old('security_approval_number', $foreigner->security_approval_number) }}">
    </div>

    <div class="mb-3">
        <label>تاريخ الموافقة الامنية</label>
        <input type="date" name="security_approval_date" class="form-control" value="{{ old('security_approval_date', $foreigner->security_approval_date) }}">
    </div>

    <div class="mb-3">
        <label>صورة الموافقة الامنية</label>
        <input type="file" name="security_approval_image" class="form-control-file">
        @if($foreigner->security_approval_image)
            <div class="mt-2">
                <p>الصورة الحالية:</p>
                <img src="{{ asset('storage/' . $foreigner->security_approval_image) }}" alt="صورة الموافقة الامنية" style="max-width: 200px;">
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label>رقم موافقة العمل</label>
        <input type="text" name="work_approval_number" class="form-control" value="{{ old('work_approval_number', $foreigner->work_approval_number) }}">
    </div>

    <div class="mb-3">
        <label>تاريخ موافقة العمل</label>
        <input type="date" name="work_approval_date" class="form-control" value="{{ old('work_approval_date', $foreigner->work_approval_date) }}">
    </div>

    <div class="mb-3">
        <label>صورة موافقة العمل</label>
        <input type="file" name="work_approval_image" class="form-control-file">
        @if($foreigner->work_approval_image)
            <div class="mt-2">
                <p>الصورة الحالية:</p>
                <img src="{{ asset('storage/' . $foreigner->work_approval_image) }}" alt="صورة موافقة العمل" style="max-width: 200px;">
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label>اسم الموظف</label>
        <select name="employee_id" class="form-control">
            <option value="">-- اختر الموظف --</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ old('employee_id', $foreigner->employee_id) == $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Date Created and Modified -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_created">تاريخ الإنشاء</label>
                <input type="date" class="form-control @error('date_created') is-invalid @enderror" 
                       id="date_created" name="date_created" 
                       value="{{ old('date_created', $foreigner->date_created) }}">
                @error('date_created')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_modified">تاريخ التعديل</label>
                <input type="date" class="form-control @error('date_modified') is-invalid @enderror" 
                       id="date_modified" name="date_modified" 
                       value="{{ old('date_modified', $foreigner->date_modified) }}">
                @error('date_modified')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">تحديث</button>
    <a href="{{ route('foreigners.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection