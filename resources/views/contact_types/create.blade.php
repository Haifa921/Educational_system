@extends('layouts.master')
@section('title', 'انشاء نوع جهة الاتصال')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>إنشاء نوع جهة اتصال</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('contact-types.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="type_value" class="form-label">نوع القيمة</label>
                        <input type="text" class="form-control @error('type_value') is-invalid @enderror" 
                               id="type_value" name="type_value" value="{{ old('type_value') }}" 
                               placeholder="بريد الكتروني, رقم, موبايل, etc." required>
                        @error('type_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">ملاحظة (اختياري)</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                  id="note" name="note" rows="3" placeholder="معلومات اضافية...">{{ old('note') }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">إنشاء</button>
                    <a href="{{ route('contact-types.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection