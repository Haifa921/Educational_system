@extends('layouts.master')
@section('title', '  تعديل جهة الاتصال')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تعديل جهة الاتصال</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('contacts.update', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">الموظف</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" required>
                            <option value="">اختيار موظف</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $contact->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact_type_id" class="form-label">نوع جهة الاتصال</label>
                        <select class="form-control @error('contact_type_id') is-invalid @enderror" id="contact_type_id" name="contact_type_id" required>
                            <option value="">اختيار نوع جهة الاتصال</option>
                            @foreach($contactTypes as $contactType)
                                <option value="{{ $contactType->id }}" {{ old('contact_type_id', $contact->contact_type_id) == $contactType->id ? 'selected' : '' }}>
                                    {{ $contactType->type_value }}
                                </option>
                            @endforeach
                        </select>
                        @error('contact_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact_value" class="form-label">Contact Value</label>
                        <input type="text" class="form-control @error('contact_value') is-invalid @enderror" 
                               id="contact_value" name="contact_value" value="{{ old('contact_value', $contact->contact_value) }}" 
                               placeholder="Email, Phone Number, etc." required>
                        @error('contact_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">ملاحظة (اختياري)</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                  id="note" name="note" rows="2" placeholder="Additional notes...">{{ old('note', $contact->note) }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">تعديل</button>
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection