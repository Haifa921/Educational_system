@extends('layouts.master')
@section('title', 'إضافة صلاحية تدريس مقرر')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة صلاحية تدريس مقرر جديد</h3>
                    <a href="{{ route('iust-courses-intitled.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('iust-courses-intitled.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">الموظف *</label>
                                    <select class="form-control @error('employee_id') is-invalid @enderror" 
                                            id="employee_id" name="employee_id" required>
                                        <option value="">اختر الموظف</option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iust_course_id">المقرر *</label>
                                    <select class="form-control @error('iust_course_id') is-invalid @enderror" 
                                            id="iust_course_id" name="iust_course_id" required>
                                        <option value="">اختر المقرر</option>
                                        @foreach($iustCourses as $course)
                                            <option value="{{ $course->id }}" {{ old('iust_course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('iust_course_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ministerial_resolution_number">رقم القرار الوزاري *</label>
                                    <input type="text" class="form-control @error('ministerial_resolution_number') is-invalid @enderror" 
                                           id="ministerial_resolution_number" name="ministerial_resolution_number" 
                                           value="{{ old('ministerial_resolution_number') }}" 
                                           placeholder="أدخل رقم القرار الوزاري" required>
                                    @error('ministerial_resolution_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="being_taught_now">يُدرّس الآن *</label>
                                    <select class="form-control @error('being_taught_now') is-invalid @enderror" 
                                            id="being_taught_now" name="being_taught_now" required>
                                        <option value="1" {{ old('being_taught_now') == '1' ? 'selected' : '' }}>نعم</option>
                                        <option value="0" {{ old('being_taught_now') == '0' ? 'selected' : '' }}>لا</option>
                                    </select>
                                    @error('being_taught_now')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                      id="note" name="note" rows="4"
                                      placeholder="أدخل أي ملاحظات إضافية">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- قسم تواريخ النظام -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_created">تاريخ الإنشاء</label>
                                    <input type="datetime-local" class="form-control @error('date_created') is-invalid @enderror" 
                                           id="date_created" name="date_created" 
                                           value="{{ old('date_created', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}">
                                    @error('date_created')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">اتركه فارغاً لاستخدام التاريخ الحالي تلقائياً</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_modified)">تاريخ التعديل</label>
                                    <input type="datetime-local" class="form-control @error('date_modified)') is-invalid @enderror" 
                                           id="date_modified)" name="date_modified)" 
                                           value="{{ old('date_modified)', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}">
                                    @error('date_modified)')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">اتركه فارغاً لاستخدام التاريخ الحالي تلقائياً</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> حفظ الصلاحية
                            </button>
                            <a href="{{ route('iust-courses-intitled.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تعيين التاريخ الحالي تلقائياً للحقول إذا كانت فارغة
    const dateCreated = document.getElementById('date_created');
    const dateModified = document.getElementById('date_modified)');
    
    if (!dateCreated.value) {
        dateCreated.value = new Date().toISOString().slice(0, 16);
    }
    
    if (!dateModified.value) {
        dateModified.value = new Date().toISOString().slice(0, 16);
    }
});
</script>
@endsection