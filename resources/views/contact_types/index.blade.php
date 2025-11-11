@extends('layouts.master')
@section('title', ' نوع جهة الاتصال')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> نوع جهات الاتصال</h3>
    
    <a href="{{ route('contact-types.create') }}" class="btn btn-primary">إنشاء نوع جهة اتصال</a>
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
            <th>رقم</th>
            <th>نوع جهة الاتصال</th>
            <th>ملاحظة</th>
            <th>عدد الاتصالات</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contactTypes as $contactType)
        <tr>
            <td>{{ $contactType->id }}</td>
            <td>{{ $contactType->type_value }}</td>
            <td>{{ Str::limit($contactType->note, 30) ?? 'N/A' }}</td>
            <td>
                <span class="badge bg-info">{{ $contactType->contacts_count }}</span>
            </td>
            <td>
                <a href="{{ route('contact-types.show', $contactType) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('contact-types.edit', $contactType) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('contact-types.destroy', $contactType) }}" method="POST" class="d-inline">
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
    {{ $contactTypes->links() }}
</div>
</div>
</div>
</div>
</div>
</div>

@endsection