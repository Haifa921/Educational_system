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
                    <p>{{ $event->id }}</p>
                </div>
                <div class="mb-3">
                    <strong>الاسم:</strong>
                    <p>{{ $event->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>الوصف:</strong>
                    <p>{{ $event->description }}</p>
                </div>
                <div class="mb-3">
                    <strong>تعديل:</strong>
                    <p>{{ $event->note ?? 'N/A' }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">تعديل</a>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">العودة الى القائمة</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection