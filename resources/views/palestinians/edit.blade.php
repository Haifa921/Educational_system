@extends('layouts.master')
@section('title', ' تعديل الموظفين الفلسطينين ')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تعديل سجل الموظفين</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('palestinians.update', $palestinian) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="family_card_number" class="form-label">رقم البطاقة العائلي</label>
                        <input type="text" class="form-control @error('family_card_number') is-invalid @enderror" 
                               id="family_card_number" name="family_card_number" value="{{ old('family_card_number', $palestinian->family_card_number) }}" required>
                        @error('family_card_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="origin_place" class="form-label">مكان الاصل</label>
                        <input type="text" class="form-control @error('origin_place') is-invalid @enderror" 
                               id="origin_place" name="origin_place" value="{{ old('origin_place', $palestinian->origin_place) }}" required>
                        @error('origin_place')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_created" class="form-label">تاريخ الإنشاء</label>
                        <input type="date" class="form-control @error('date_created') is-invalid @enderror" 
                               id="date_created" name="date_created" value="{{ old('date_created', \Carbon\Carbon::parse($palestinian->date_created)->format('Y-m-d')) }}" required>
                        @error('date_created')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_modified" class="form-label">Date Modified</label>
                        <input type="date" class="form-control @error('date_modified)') is-invalid @enderror" 
                               id="date_modified" name="date_modified)" 
                               value="{{ old('date_modified)', \Carbon\Carbon::parse($palestinian->{'date_modified)'})->format('Y-m-d')) }}" 
                               required>
                        @error('date_modified)')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">الموظف المرتبط (اختياري)</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                            <option value="">اختيار الموظف</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $palestinian->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> تعديل السجل
                        </button>
                        <a href="{{ route('palestinians.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> إلغاء
                        </a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection