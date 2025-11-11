@extends('layouts.master')
@section('title', '  عرض جهة الاتصال')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تفاصيل جهة الاتصال </h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>الرقم:</strong>
                    <p>{{ $contact->id }}</p>
                </div>
                <div class="mb-3">
                    <strong>الموظف:</strong>
                    <p>{{ $contact->employee->first_name}}</p>
                </div>
                <div class="mb-3">
                    <strong>نوع جهة التواصل:</strong>
                    <p>{{ $contact->contact_type->type_value}}</p>
                </div>
                <div class="mb-3">
                    <strong>قيمة جهة التواصل:</strong>
                    <p>{{ $contact->contact_value }}</p>
                </div>
                <div class="mb-3">
                    <strong>ملاحظة:</strong>
                    <p>{{ $contact->note  }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">تعديل</a>
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary"> عودة الى القائمة </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection