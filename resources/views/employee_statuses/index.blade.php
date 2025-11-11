@extends('layouts.master')
@section('title', 'إدارة حالات الموظفين')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة حالات الموظفين</h3>
                    <div class="card-tools">
                        <a href="{{ route('employee-statuses.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة حالة موظف جديدة
                        </a>
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
                                    <th>#</th>
                                    <th>اسم الحالة</th>
                                    <th>عدد الموظفين</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeeStatuses as $status)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $status->employees_count }}</span>
                                    </td>
                                    <td>{{ $status->date_careted ? $status->date_careted : $status->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $status->date_modified ? $status->date_modified : $status->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('employee-statuses.show', $status->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('employee-statuses.edit', $status->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employee-statuses.destroy', $status->id) }}" 
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
                        {{ $employeeStatuses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection