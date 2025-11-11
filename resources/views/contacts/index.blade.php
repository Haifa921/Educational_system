@extends('layouts.master')
@section('title', '  التواصل')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> جهات الاتصال</h3>
 
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">إنشاء جهة اتصال جديدة</a>
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
            <th>الموظف</th>
            <th>نوع جهة الاتصال</th>
            <th>قيمة جهة الاتصال</th>
            <th>ملاحظة</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->employee->name ?? 'N/A' }}</td>
            <td>{{ $contact->contact_type->type_value ?? 'N/A' }}</td>
            <td>{{ $contact->contact_value }}</td>
            <td>{{ Str::limit($contact->note, 30) ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
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
    {{ $contacts->links() }}
</div>
</div>
</div>
</div>
</div>
</div>

@endsection