<!-- resources/views/universities/create.blade.php -->
@extends('layouts.master')
@section('title', 'إضافة جامعة')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">إضافة جامعة جديدة</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('universities.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">اسم الجامعة *</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" required placeholder="أدخل اسم الجامعة">
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
                                <input type="datetime-local" name="date_created" id="date_created" 
                                       class="form-control @error('date_created') is-invalid @enderror" 
                                       value="{{ old('date_created', now()->format('Y-m-d\TH:i')) }}">
                                @error('date_created')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_modified)">تاريخ التعديل</label>
                                <input type="datetime-local" name="date_modified)" id="date_modified)" 
                                       class="form-control @error('date_modified)') is-invalid @enderror" 
                                       value="{{ old('date_modified)', now()->format('Y-m-d\TH:i')) }}">
                                @error('date_modified)')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="disableButton(this)">
                            <i class="fe fe-save"></i> حفظ الجامعة
                        </button>
                        <a href="{{ route('universities.index') }}" class="btn btn-secondary">
                            <i class="fe fe-arrow-right"></i> رجوع للقائمة
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Set default values for date fields
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        const nowString = now.toISOString().slice(0, 16);
        
        if (!document.getElementById('date_created').value) {
            document.getElementById('date_created').value = nowString;
        }
        if (!document.getElementById('date_modified)').value) {
            document.getElementById('date_modified)').value = nowString;
        }
    });
</script>
@endsection