@extends('layouts.master')
@section('title', 'إدارة التخصصات')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة التخصصات</h3>
                    <div class="card-tools">
                        <a href="{{ route('majors.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة تخصص جديد
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
                                    <th>اسم التخصص</th>
                                    <th>الكلية</th>
                                    <th>عدد الموظفين</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($majors as $major)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $major->name }}</td>
                                    <td>{{ $major->faculty->name ?? 'غير محدد' }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $major->employees_count }}</span>
                                    </td>
                                    <td>{{ $major->note ? \Illuminate\Support\Str::limit($major->note, 50) : 'لا توجد ملاحظات' }}</td>
                                    <td>{{ $major->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('majors.show', $major->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('majors.edit', $major->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('majors.destroy', $major->id) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا التخصص؟')">
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
                        {{ $majors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection