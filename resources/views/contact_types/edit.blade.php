@extends('layouts.master')
@section('title', 'تعديل نوع جهة الاتصال')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تعديل نوع جهة الاتصال</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('contact-types.update', $contactType) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="type_value" class="form-label">نوع جهة الاتصال</label>
                        <input type="text" class="form-control @error('type_value') is-invalid @enderror" 
                               id="type_value" name="type_value" value="{{ old('type_value', $contactType->type_value) }}" 
                               placeholder="Email, Phone, Mobile, etc." required>
                        @error('type_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">ملاحظة (اختياري)</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                  id="note" name="note" rows="3" placeholder="وصف إضافي...">{{ old('note', $contactType->note) }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">تعديل نوع جهة الاتصال</button>
                    <a href="{{ route('contact-types.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection