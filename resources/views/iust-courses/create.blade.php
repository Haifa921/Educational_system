@extends('layouts.master')
@section('title', 'إضافة مقرر للجامعة الدولية')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة مقرر جامعي جديد</h3>
                    <a href="{{ route('iust-courses.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('iust-courses.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">اسم المقرر *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="أدخل اسم المقرر" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                      id="note" name="note" rows="4"
                                      placeholder="أدخل أي ملاحظات إضافية عن المقرر">{{ old('note') }}</textarea>
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
                                <i class="fas fa-save"></i> حفظ المقرر
                            </button>
                            <a href="{{ route('iust-courses.index') }}" class="btn btn-secondary">
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