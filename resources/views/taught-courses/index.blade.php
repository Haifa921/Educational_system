@extends('layouts.master')
@section('title', 'المقررات المدّرسة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">المقررات المدّرسة</h3>
                    <div class="card-tools">
                        <a href="{{ route('taught-courses.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة مقرر مدّرس جديد
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
                                    <th>الجامعة</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($taughtCourses as $taughtCourse)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $taughtCourse->employee->first_name ?? '' }} {{ $taughtCourse->employee->last_name ?? '' }}</td>
                                    <td>{{ $taughtCourse->course->name ?? '' }}</td>
                                    <td>{{ $taughtCourse->university->name ?? '' }}</td>
                                    <td>{{ $taughtCourse->note ? \Str::limit($taughtCourse->note, 50) : '---' }}</td>
                                    <td>{{ $taughtCourse->date_created ? \Carbon\Carbon::parse($taughtCourse->date_created)->format('Y-m-d') : '---' }}</td>
                                    <td>
                                        <a href="{{ route('taught-courses.show', $taughtCourse) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('taught-courses.edit', $taughtCourse) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('taught-courses.destroy', $taughtCourse) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المقرر المدّرس؟');">
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
                                    <td colspan="7" class="text-center">لا توجد مقررات مدّرسة</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $taughtCourses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection