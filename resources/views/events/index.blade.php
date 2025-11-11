@extends('layouts.master')
@section('title', ' الأحداث الوظيفية')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
    <h1>الأحداث الوظيفية</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">إنشاء حدث جديد</a>
</div>
</div>
<div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>الوصف</th>
            <th>ملاحظات</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->id }}</td>
            <td>{{ $event->name }}</td>
            <td>{{ Str::limit($event->description, 50) }}</td>
            <td>{{ Str::limit($event->note, 30) ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد?')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
    {{ $events->links() }}
</div>
</div>
</div>
</div>
</div>
</div>

@endsection