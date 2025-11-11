@extends('layouts.master')
@section('title', 'إدارة المسميات الوظيفية')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة المسميات الوظيفية</h3>
                    <div class="card-tools">
                        <a href="{{ route('positions.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة مسمى وظيفي جديد
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
                                    <th>اسم المسمى الوظيفي</th>
                                    <th>عدد الموظفين</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $position)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $position->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $position->employees_count }}</span>
                                    </td>
                                    <td>{{ $position->note ? Str::limit($position->note, 50) : 'لا توجد ملاحظات' }}</td>
                                    <td>{{ $position->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('positions.show', $position->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('positions.edit', $position->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('positions.destroy', $position->id) }}" 
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
                        {{ $positions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection