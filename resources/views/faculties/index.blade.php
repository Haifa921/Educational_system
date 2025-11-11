@extends('layouts.master')
@section('title', 'إدارة الكليات')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة الكليات</h3>
                    <div class="card-tools">
                        <a href="{{ route('faculties.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة كلية جديدة
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
                                    <th>اسم الكلية</th>
                                    <th>عدد التخصصات</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faculties as $faculty)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $faculty->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $faculty->majors_count }}</span>
                                    </td>
                                    <td>{{ $faculty->note ? \Illuminate\Support\Str::limit($faculty->note, 50) : 'لا توجد ملاحظات' }}</td>
                                    <td>{{ $faculty->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('faculties.show', $faculty->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('faculties.edit', $faculty->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('faculties.destroy', $faculty->id) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه الكلية؟')">
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
                        {{ $faculties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection