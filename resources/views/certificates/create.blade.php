@extends('layouts.master')
@section('title', 'إضافة شهادة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة شهادة جديدة</h3>
                    <a href="{{ route('certificates.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">اسم الشهادة *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="أدخل اسم الشهادة" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="certificate_type_id">نوع الشهادة *</label>
                                    <select class="form-control @error('certificate_type_id') is-invalid @enderror" 
                                            id="certificate_type_id" name="certificate_type_id" required>
                                        <option value="">اختر نوع الشهادة</option>
                                        @foreach($certificateTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('certificate_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('certificate_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="specializaion_id">التخصص *</label>
                                    <select class="form-control @error('specializaion_id') is-invalid @enderror" 
                                            id="specializaion_id" name="specializaion_id" required>
                                        <option value="">اختر التخصص</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{ $specialization->id }}" {{ old('specializaion_id') == $specialization->id ? 'selected' : '' }}>
                                                {{ $specialization->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('specializaion_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country_id">البلد *</label>
                                    <select class="form-control @error('country_id') is-invalid @enderror" 
                                            id="country_id" name="country_id" required>
                                        <option value="">اختر البلد</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thesis_title">عنوان الرسالة</label>
                                    <input type="text" class="form-control @error('thesis_title') is-invalid @enderror" 
                                           id="thesis_title" name="thesis_title" value="{{ old('thesis_title') }}"
                                           placeholder="أدخل عنوان الرسالة">
                                    @error('thesis_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">الشركة</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                           id="company" name="company" value="{{ old('company') }}"
                                           placeholder="أدخل اسم الشركة">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- قسم تاريخ الإصدار والملف -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="release-date">تاريخ الإصدار *</label>
                                    <input type="date" class="form-control @error('release-date') is-invalid @enderror" 
                                           id="release-date" name="release-date" 
                                           value="{{ old('release-date', date('Y-m-d')) }}" required>
                                    @error('release-date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">تاريخ حصول الموظف على الشهادة</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_file">ملف الشهادة</label>
                                    <input type="file" class="form-control-file @error('certificate_file') is-invalid @enderror" 
                                           id="certificate_file" name="certificate_file"
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('certificate_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">PDF, JPG, PNG, JPEG - الحد الأقصى 2MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4"
                                      placeholder="أدخل وصفاً للشهادة">{{ old('description') }}</textarea>
                            @error('description')
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
                                           value="{{ old('date_created', date('Y-m-d\TH:i')) }}">
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
                                           value="{{ old('date_modified)', date('Y-m-d\TH:i')) }}">
                                    @error('date_modified)')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">اتركه فارغاً لاستخدام التاريخ الحالي تلقائياً</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> حفظ الشهادة
                            </button>
                            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">
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
    const releaseDate = document.getElementById('release-date');
    
    if (!dateCreated.value) {
        dateCreated.value = new Date().toISOString().slice(0, 16);
    }
    
    if (!dateModified.value) {
        dateModified.value = new Date().toISOString().slice(0, 16);
    }
    
    // إذا كان تاريخ الإصدار فارغاً، ضع تاريخ اليوم
    if (!releaseDate.value) {
        releaseDate.value = new Date().toISOString().slice(0, 10);
    }
});
</script>
@endsection