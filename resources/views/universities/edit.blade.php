<!-- resources/views/universities/edit.blade.php -->
@extends('layouts.master')
@section('title', 'تعديل جامعة')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تعديل الجامعة</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('universities.update', $university) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">اسم الجامعة *</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $university->name) }}" required placeholder="أدخل اسم الجامعة">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Date Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_created">تاريخ الإنشاء</label>
                                @php
                                    $dateCreated = $university->date_created;
                                    if (is_string($dateCreated)) {
                                        $dateCreated = \Carbon\Carbon::parse($dateCreated);
                                    }
                                @endphp
                                <input type="datetime-local" name="date_created" id="date_created" 
                                       class="form-control @error('date_created') is-invalid @enderror" 
                                       value="{{ old('date_created', $dateCreated ? $dateCreated->format('Y-m-d\TH:i') : '') }}">
                                @error('date_created')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_modified">تاريخ التعديل</label>
                                <input type="datetime-local" name="date_modified" id="date_modified" 
                                       class="form-control @error('date_modified') is-invalid @enderror" 
                                       value="{{ old('date_modified', now()->format('Y-m-d\TH:i')) }}">
                                <small class="form-text text-muted">سيتم تحديث هذا الحقل تلقائياً عند الحفظ</small>
                                @error('date_modified')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Display current dates as reference -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الإنشاء الحالي:</label>
                                @php
                                    $currentDateCreated = $university->date_created;
                                    if (is_string($currentDateCreated)) {
                                        $currentDateCreated = \Carbon\Carbon::parse($currentDateCreated);
                                    }
                                @endphp
                                <p class="form-control-plaintext border rounded p-2 bg-light">
                                    {{ $currentDateCreated ? $currentDateCreated->format('Y-m-d H:i') : 'غير محدد' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>آخر تعديل:</label>
                                @php
                                    $currentDateModified = $university->date_modified;
                                    if (is_string($currentDateModified)) {
                                        $currentDateModified = \Carbon\Carbon::parse($currentDateModified);
                                    }
                                @endphp
                                <p class="form-control-plaintext border rounded p-2 bg-light">
                                    {{ $currentDateModified ? $currentDateModified->format('Y-m-d H:i') : 'غير محدد' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="disableButton(this)">
                            <i class="fe fe-save"></i> تحديث البيانات
                        </button>
                        <a href="{{ route('universities.index') }}" class="btn btn-secondary">
                            <i class="fe fe-arrow-right"></i> رجوع للقائمة
                        </a>
                        <a href="{{ route('universities.show', $university) }}" class="btn btn-info">
                            <i class="fe fe-eye"></i> عرض التفاصيل
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-update date_modified to current time when form is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        const nowString = now.toISOString().slice(0, 16);
        document.getElementById('date_modified').value = nowString;
    });
</script>
@endsection