@extends('layouts.master')
@section('title', 'تعديل بيانات الموظف')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل بيانات الموظف: {{ $employee->first_name }} {{ $employee->last_name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Personal Information -->
                        <h4 class="mb-3">المعلومات الشخصية</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الاسم الأول *</label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                                           value="{{ old('first_name', $employee->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الاسم الأخير *</label>
                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                                           value="{{ old('last_name', $employee->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الرقم الوطني *</label>
                                    <input type="text" name="national_number" class="form-control @error('national_number') is-invalid @enderror" 
                                           value="{{ old('national_number', $employee->national_number) }}" required>
                                    @error('national_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاريخ الميلاد *</label>
                                    <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                                    value="{{ old('birth_date', $employee->birth_date ? (\Carbon\Carbon::parse($employee->birth_date))->format('Y-m-d') : '') }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الجنس *</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="">اختر الجنس</option>
                                        <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Scientific Information -->
                        <h4 class="mb-3 mt-4">المعلومات العلمية</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الرتبة العلمية *</label>
                                    <input type="text" name="scientific_rank" class="form-control @error('scientific_rank') is-invalid @enderror" 
                                           value="{{ old('scientific_rank', $employee->scientific_rank) }}" required>
                                    @error('scientific_rank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاريخ الحصول على الرتبة العلمية *</label>
                                    <input type="date" name="scientific_rank_obtaining_date" class="form-control @error('scientific_rank_obtaining_date') is-invalid @enderror" 
                                    value="{{ old('scientific_rank_obtaining_date', ! empty($employee->scientific_rank_obtaining_date)
                                    ? \Carbon\Carbon::parse($employee->scientific_rank_obtaining_date)->format('Y-m-d')
                                    : ''
                                ) }}"required>
                                    @error('scientific_rank_obtaining_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>التخصص العام *</label>
                                    <input type="text" name="general_specialization" class="form-control @error('general_specialization') is-invalid @enderror" 
                                           value="{{ old('general_specialization', $employee->general_specialization) }}" required>
                                    @error('general_specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>التخصص الدقيق *</label>
                                    <input type="text" name="detailed_specialization" class="form-control @error('detailed_specialization') is-invalid @enderror" 
                                           value="{{ old('detailed_specialization', $employee->detailed_specialization) }}" required>
                                    @error('detailed_specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الجهة الحكومية التابع لها</label>
                                    <input type="text" name="affiliated_government_agency" class="form-control @error('affiliated_government_agency') is-invalid @enderror" 
                                           value="{{ old('affiliated_government_agency', $employee->affiliated_government_agency) }}">
                                    @error('affiliated_government_agency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Employment Information -->
                        <h4 class="mb-3 mt-4">المعلومات الوظيفية</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>المنصب *</label>
                                    <select name="position_id" class="form-control @error('position_id') is-invalid @enderror" required>
                                        <option value="">اختر المنصب</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>المنطقة *</label>
                                    <select name="region_id" class="form-control @error('region_id') is-invalid @enderror" required>
                                        <option value="">اختر المنطقة</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ old('region_id', $employee->region_id) == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>التخصص *</label>
                                    <select name="major_id" class="form-control @error('major_id') is-invalid @enderror" required>
                                        <option value="">اختر التخصص</option>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}" {{ old('major_id', $employee->major_id) == $major->id ? 'selected' : '' }}>
                                                {{ $major->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('major_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الحالة الوظيفية *</label>
                                    <select name="status_id" class="form-control @error('status_id') is-invalid @enderror" required>
                                        <option value="">اختر الحالة</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('status_id', $employee->status_id) == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>عدد أيام التوفر</label>
                                    <input type="number" step="0.1" name="availability_days_count" class="form-control @error('availability_days_count') is-invalid @enderror" 
                                           value="{{ old('availability_days_count', $employee->availability_days_count) }}" min="0" max="365">
                                    @error('availability_days_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>عدد ساعات التوفر</label>
                                    <input type="number" step="0.1" name="availability_hours_count" class="form-control @error('availability_hours_count') is-invalid @enderror" 
                                           value="{{ old('availability_hours_count', $employee->availability_hours_count) }}" min="0" max="365">
                                    @error('availability_hours_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_contracted" value="1" 
                                               class="form-check-input" id="is_contracted"
                                               {{ old('is_contracted', $employee->is_contracted) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_contracted">موظف بعقد</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <h4 class="mb-3 mt-4">الصور</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الصورة الشخصية الحالية</label>
                                    @if($employee->personal_image)
                                        <img src="{{ asset('storage/' . $employee->personal_image) }}" 
                                             alt="صورة الموظف" width="100" class="d-block mb-2 rounded">
                                    @else
                                        <span class="text-muted">لا توجد صورة</span>
                                    @endif
                                    <input type="file" name="personal_image" class="form-control-file @error('personal_image') is-invalid @enderror" 
                                           accept="image/jpeg,image/png,image/jpg,image/gif">
                                    @error('personal_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>صورة الهوية الحالية</label>
                                    @if($employee->id_image)
                                        <img src="{{ asset('storage/' . $employee->id_image) }}"
                                             alt="صورة الهوية" width="100" class="d-block mb-2 rounded">
                                    @else
                                        <span class="text-muted">لا توجد صورة</span>
                                    @endif
                                    <input type="file" name="id_image" class="form-control-file @error('id_image') is-invalid @enderror" 
                                           accept="image/jpeg,image/png,image/jpg,image/gif">
                                    @error('id_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> تحديث البيانات
                            </button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
use Illuminate\Support\Facades\Storage;
@endphp