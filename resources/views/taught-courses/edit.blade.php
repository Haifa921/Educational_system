@extends('layouts.master')
@section('title', 'تعديل مقرر مدّرس')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل مقرر مدّرس</h3>
                    <a href="{{ route('taught-courses.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('taught-courses.update', $taughtCourse) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_id">الموظف *</label>
                                    <select class="form-control @error('employee_id') is-invalid @enderror" 
                                            id="employee_id" name="employee_id" required>
                                        <option value="">اختر الموظف</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id', $taughtCourse->employee_id) == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course_id">المقرر *</label>
                                    <select class="form-control @error('course_id') is-invalid @enderror" 
                                            id="course_id" name="course_id" required>
                                        <option value="">اختر المقرر</option>
                                        @foreach($courses as $course)
                                            {{-- تصحيح: استخدام $course->id بدلاً من $course->course_id --}}
                                            <option value="{{ $course->id }}" {{ old('course_id', $taughtCourse->course_id) == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="university_id">الجامعة *</label>
                                    <select class="form-control @error('university_id') is-invalid @enderror" 
                                            id="university_id" name="university_id" required>
                                        <option value="">اختر الجامعة</option>
                                        @foreach($universities as $university)
                                            <option value="{{ $university->id }}" {{ old('university_id', $taughtCourse->university_id) == $university->id ? 'selected' : '' }}>
                                                {{ $university->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('university_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                      id="note" name="note" rows="4"
                                      placeholder="أدخل أي ملاحظات إضافية">{{ old('note', $taughtCourse->note) }}</textarea>
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
                                           value="{{ old('date_created', $taughtCourse->date_created ? \Carbon\Carbon::parse($taughtCourse->date_created)->format('Y-m-d\TH:i') : '') }}">
                                    @error('date_created')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <small class="form-text text-muted">سيتم تحديثه تلقائياً إلى الوقت الحالي</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> تحديث المقرر المدّرس
                            </button>
                            <a href="{{ route('taught-courses.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                            <a href="{{ route('taught-courses.show', $taughtCourse) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> عرض التفاصيل
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
    // تحديث تاريخ التعديل تلقائياً إلى الوقت الحالي
    const dateModified = document.getElementById('date_modified)');
    dateModified.value = new Date().toISOString().slice(0, 16);
});
</script>
@endsection