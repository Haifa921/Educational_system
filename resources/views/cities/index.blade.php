@extends('layouts.master')
@section('title', 'إدارة المدن')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة المدن</h3>
                    <div class="card-tools">
                        <a href="{{ route('cities.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة مدينة جديدة
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
                                    <th>اسم المدينة</th>
                                    <th>عدد المناطق</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $city->regions_count }}</span>
                                    </td>
                                    <td>{{ $city->note ? \Illuminate\Support\Str::limit($city->note, 50) : 'لا توجد ملاحظات' }}</td>
                                    <td>{{ $city->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('cities.show', $city->id) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('cities.edit', $city->id) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('cities.destroy', $city->id) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه المدينة؟')">
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
                        {{ $cities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection