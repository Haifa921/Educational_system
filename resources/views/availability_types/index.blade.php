@extends('layouts.master')
@section('title', 'إدارة أنواع التوفر')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة أنواع التوفر</h3>
                    <div class="card-tools">
                        <a href="{{ route('availability-types.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة نوع توفر جديد
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
                                    <th>اسم نوع التوفر</th>
                                    <th>عدد الساعات</th>
                                    <th>عدد الموظفين</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>تاريخ التعديل</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availabilityTypes as $type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $type->hours_count }} ساعة</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">{{ $type->employees_count }}</span>
                                    </td>
                                    <td>{{ $type->date_created ? $type->date_created : $type->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $type->date_modified ? $type->date_modified : $type->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('availability-types.show', $type->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('availability-types.edit', $type->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('availability-types.destroy', $type->id) }}" 
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
                        {{ $availabilityTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection