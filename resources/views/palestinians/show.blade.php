@extends('layouts.master')
@section('title', 'عرض  السجل')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تفاصيل سجل الموظف</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>الرقم:</strong>
                    <p>{{ $palestinian->id }}</p>
                </div>
                <div class="mb-3">
                    <strong>رقم البطاقة العائلي:</strong>
                    <p>{{ $palestinian->family_card_number }}</p>
                </div>
                <div class="mb-3">
                    <strong>مكان الاصل:</strong>
                    <p>{{ $palestinian->origin_place }}</p>
                </div>
                <div class="mb-3">
                    <strong>تاريخ الانشاء:</strong>
                    <p>{{ \Carbon\Carbon::parse($palestinian->date_created)->format('Y-m-d') }}</p>
                </div>
                <div class="mb-3">
                    <strong>Date Modified:</strong>
                    <p>{{ \Carbon\Carbon::parse($palestinian->date_modified)->format('Y-m-d') }}</p>
                </div>
                <div class="mb-3">
                    <strong>الموظف المرتبط به:</strong>
                    <p>{{ $palestinian->employee->name ?? 'N/A' }}</p>
                </div>
           
                <div class="mt-4">
                    <a href="{{ route('palestinians.edit', $palestinian) }}" class="btn btn-warning">تعديل</a>
                    <a href="{{ route('palestinians.index') }}" class="btn btn-secondary">رجوع الى القائمة</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection