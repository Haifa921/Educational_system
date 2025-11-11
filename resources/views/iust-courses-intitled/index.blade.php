@extends('layouts.master')
@section('title', 'صلاحيات تدريس مقررات الجامعة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">صلاحيات تدريس مقررات الجامعة</h3>
                    <div class="card-tools">
                        <a href="{{ route('iust-courses-intitled.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة صلاحية جديدة
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
                                    <th>الموظف</th>
                                    <th>المقرر</th>
                                    <th>رقم القرار الوزاري</th>
                                    <th>يُدرّس الآن</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coursesIntitled as $courseIntitled)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $courseIntitled->employee->first_name ?? '' }} {{ $courseIntitled->employee->last_name ?? '' }}</td>
                                    <td>{{ $courseIntitled->iust_course->name ?? '' }}</td>
                                    <td>{{ $courseIntitled->ministerial_resolution_number }}</td>
                                    <td>
                                        @if($courseIntitled->being_taught_now)
                                            <span class="badge badge-success">نعم</span>
                                        @else
                                            <span class="badge badge-secondary">لا</span>
                                        @endif
                                    </td>
                                    <td>{{ $courseIntitled->date_created ? \Carbon\Carbon::parse($courseIntitled->date_created)->format('Y-m-d') : '---' }}</td>
                                    <td>
                                        <a href="{{ route('iust-courses-intitled.show', $courseIntitled) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('iust-courses-intitled.edit', $courseIntitled) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('iust-courses-intitled.destroy', $courseIntitled) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا توجد صلاحيات تدريس</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $coursesIntitled->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection