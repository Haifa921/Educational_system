@extends('layouts.master')
@section('title', 'الموظفين الفلسطينين ')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>إضافة سجل جديد</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('palestinians.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="family_card_number" class="form-label">رقم البطاقة العائلي</label>
                        <input type="text" class="form-control @error('family_card_number') is-invalid @enderror" 
                               id="family_card_number" name="family_card_number" value="{{ old('family_card_number') }}" required>
                        @error('family_card_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="origin_place" class="form-label">مكان الاصل</label>
                        <input type="text" class="form-control @error('origin_place') is-invalid @enderror" 
                               id="origin_place" name="origin_place" value="{{ old('origin_place') }}" required>
                        @error('origin_place')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_created" class="form-label">تاريخ الانشاء</label>
                        <input type="date" class="form-control @error('date_created') is-invalid @enderror" 
                               id="date_created" name="date_created" value="{{ old('date_created', now()->format('Y-m-d')) }}" required>
                        @error('date_created')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_modified)" class="form-label">تاريخ التعديل</label>
                        <input type="date" class="form-control @error('date_modified)') is-invalid @enderror" 
                               id="date_modified)" name="date_modified)" value="{{ old('date_modified)', now()->format('Y-m-d')) }}" required>
                        @error('date_modified)')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">الموظف المرتبط به (اختياري)</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                            <option value="">اختيار موظف</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">إنشاء السجل</button>
                    <a href="{{ route('palestinians.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection