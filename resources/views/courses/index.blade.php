@extends('layouts.master')
@section('title', ' جميع المقررات  ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مقررات </h3>
                    <div class="card-tools">
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة مقرر جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
            <th>رقم</th>
            <th>الاسم</th>
            <th>تاريخ الانشاء</th>
            <th>تاريخ التعديل</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>
                @if($course->date_created instanceof \Carbon\Carbon)
                    {{ $course->date_created->format('Y-m-d') }}
                @else
                    {{ \Carbon\Carbon::parse($course->date_created)->format('Y-m-d') }}
                @endif
            </td>
            <td>
                @if($course->date_modified instanceof \Carbon\Carbon)
                    {{ $course->date_modified->format('Y-m-d') }}
                @else
                    {{ \Carbon\Carbon::parse($course->date_modified)->format('Y-m-d') }}
                @endif
            </td>
            <td>
                <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متاكد?')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection