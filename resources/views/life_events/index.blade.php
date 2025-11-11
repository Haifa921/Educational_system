@extends('layouts.master')
@section('title', ' الأحداث الحياتية')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

    <h1>الاحداث الحياتية</h1>
    <a href="{{ route('life-events.create') }}" class="btn btn-primary">إنشاء حدث حياتي جديد</a>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>رقم</th>
            <th>تاريخ</th>
            <th>الموظف</th>
            <th>الحدث</th>
            <th>الوصف</th>
            <th>ملاحظة</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lifeEvents as $lifeEvent)
        <tr>
            <td>{{ $lifeEvent->id }}</td>
            <td>{{ \Carbon\Carbon::parse($lifeEvent->date)->format('Y-m-d') }}</td>
            <td>{{ $lifeEvent->employee->name ?? 'N/A' }}</td>
            <td>{{ $lifeEvent->event->name ?? 'N/A' }}</td>
            <td>{{ Str::limit($lifeEvent->description, 50) }}</td>
            <td>{{ Str::limit($lifeEvent->note, 30) ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('life-events.show', $lifeEvent) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('life-events.edit', $lifeEvent) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('life-events.destroy', $lifeEvent) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد?')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $lifeEvents->links() }}
@endsection