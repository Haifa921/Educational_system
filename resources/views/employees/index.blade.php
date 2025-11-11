@extends('layouts.master')
@section('title', 'إدارة الموظفين')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة الموظفين</h3>
                    <div class="card-tools">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة موظف جديد
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
                                    <th>#</th>
                                    <th>الصورة</th>
                                    <th>الاسم</th>
                                    <th>الرقم الوطني</th>
                                    <th>المسمى الوظيفي</th>
                                    <th>المنطقة</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($employee->personal_image)
                                            <img src="{{ asset('storage/' . $employee->personal_image) }}" 
                                                 alt="صورة الموظف" width="50" height="50" class="img-fluid">
                                        @else
                                            <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                                 alt="صورة افتراضية" width="50" height="50" class="img-fluid">
                                        @endif
                                    </td>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->national_number }}</td>
                                    <td>{{ $employee->Position->name ?? 'غير محدد' }}</td>
                                    <td>{{ $employee->Region->name ?? 'غير محدد' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $employee->Status->color ?? 'secondary' }}">
                                            {{ $employee->Status->name ?? 'غير محدد' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('employees.show', $employee->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection