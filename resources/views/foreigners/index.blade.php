@extends('layouts.master')
@section('title', 'الموظفين الاجانب')

@section('content')
<hr>
<h1>الموظفين الاجانب</h1>

<a href="{{ route('foreigners.create') }}" class="btn btn-primary mb-3">اضافة موظف</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>رقم</th>
            <th>رقم الجواز</th>
            <th>تاريخ المنح</th>
            <th>صلاحية الجواز</th>
            <th>اسم الموظف</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foreigners as $foreigner)
        <tr>
            <td>{{ $foreigner->id }}</td>
            <td>{{ $foreigner->passport_number }}</td>
            <td>{{ $foreigner->passport_release_date }}</td>
            <td>{{ $foreigner->passport_valid_date }}</td>
            <td>{{ $foreigner->Employee->first_name ?? '—' }} {{ $foreigner->Employee->last_name ?? '' }}</td>
            <td>
                <a href="{{ route('foreigners.show', $foreigner) }}" class="btn btn-sm btn-info">عرض</a>
                <a href="{{ route('foreigners.edit', $foreigner) }}" class="btn btn-sm btn-warning">تعديل</a>
                <form action="{{ route('foreigners.destroy', $foreigner) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this entry?')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $foreigners->links() }}
@endsection