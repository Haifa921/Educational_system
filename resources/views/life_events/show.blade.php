@extends('layouts.master')
@section('title', ' عرض الأحداث الوظيفية')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تفاصيل الحدث الوظيفي</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>الرقم:</strong>
                    <p>{{ $lifeEvent->id }}</p>
                </div>
                <div class="mb-3">
                    <strong>تاريخ:</strong>
                    <p>{{ \Carbon\Carbon::parse($lifeEvent->date)->format('Y-m-d') }}</p>
                </div>
                <div class="mb-3">
                    <strong>الموظف:</strong>
                    <p>{{ $lifeEvent->employee->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Event:</strong>
                    <p>{{ $lifeEvent->event->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <strong>الوصف:</strong>
                    <p>{{ $lifeEvent->description }}</p>
                </div>
                <div class="mb-3">
                    <strong>ملاحظة:</strong>
                    <p>{{ $lifeEvent->note ?? 'N/A' }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('life-events.edit', $lifeEvent) }}" class="btn btn-warning">تعديل</a>
                    <a href="{{ route('life-events.index') }}" class="btn btn-secondary">الرجوع الى القائمة</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection