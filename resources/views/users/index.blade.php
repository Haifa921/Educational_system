@extends('layouts.master')
@section('title', ' المستخدمين ')

@section('content')
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
    <h3 class="card-title">المستخدمين</h3>
    
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">إنشاء مستخدم جديد

     <i class="fe fe-plus"></i> </a>

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>الصلاحيات</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
               {{ $user->role_name }}
            </td>
            <td>
                {{-- @can('view_users') --}}
                <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">عرض</a>
                {{-- @endcan --}}
                {{-- @can('edit_users') --}}
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">تعديل</a>
                {{-- @endcan --}}
                {{-- @can('delete_users') --}}
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                    {{-- @csrf --}}
                    @method('DELETE')
                    @if($user->id !== auth()->id())
<form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
        <i class="fe fe-trash"></i> حذف
    </button>
</form>
@endif  </form>
                {{-- @endcan --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endsection