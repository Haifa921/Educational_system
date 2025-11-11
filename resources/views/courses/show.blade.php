@extends('layouts.master')
@section('title', 'عرض مقرر جامعي')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تفاصيل المقرر</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>الرقم:</strong>
                    <p>{{ $course->id }}</p>
                </div>
                <div class="mb-3">
                    <strong>اسم المقرر:</strong>
                    <p>{{ $course->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>تاريخ الانشاء:</strong>
                    <p>{{ \Carbon\Carbon::parse($course->date_created)->format('Y-m-d') }}</p>
                </div>
                <div class="mb-3">
                    <strong>تاريخ التعديل:</strong>
                    <p>{{ \Carbon\Carbon::parse($course->date_modified)->format('Y-m-d') }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">تعديل</a>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">رجوع الى القائمة</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection