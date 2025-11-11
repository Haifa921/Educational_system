@extends('layouts.master')
@section('title', 'الموظفين الفلسطينين ')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
    <h1>سجلات الموظفين الفلسطينين</h1>
    <a href="{{ route('palestinians.create') }}" class="btn btn-primary">إضافة سجل</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>رقم البطاقة العائلي</th>
            <th>مكان الاصل</th>
            <th>تاريخ الإنشاء</th>
            <th>تاريخ التعديل</th>
            <th>الموظف</th>
          
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($palestinians as $palestinian)
        <tr>
            <td>{{ $palestinian->id }}</td>
            <td>{{ $palestinian->family_card_number }}</td>
            <td>{{ $palestinian->origin_place }}</td>
            <td>{{ \Carbon\Carbon::parse($palestinian->date_created)->format('Y-m-d') }}</td>
            <td>{{ \Carbon\Carbon::parse($palestinian->date_modified)->format('Y-m-d') }}</td>
            <td>
                {{ $palestinian->first_name ?? '' }} {{ $palestinian->last_name ?? '' }}
            </td>
            <td>
                <a href="{{ route('palestinians.show', $palestinian) }}" class="btn btn-info btn-sm">عرض</a>
                <a href="{{ route('palestinians.edit', $palestinian) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('palestinians.destroy', $palestinian) }}" method="POST" class="d-inline">
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
{{ $palestinians->links() }}
@endsection