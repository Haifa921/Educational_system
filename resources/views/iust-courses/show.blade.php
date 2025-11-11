@extends('layouts.master')
@section('title', 'تفاصيل المقرر الجامعي')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المقرر الجامعي</h3>
                    <a href="{{ route('iust-courses.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">اسم المقرر:</th>
                                    <td>{{ $iustCourse->name }}</td>
                                </tr>
                                <tr>
                                    <th>عدد الصلاحيات:</th>
                                    <td>
                                        <span class="badge badge-info">{{ $iustCourse->iust_course_intitled->count() }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء:</th>
                                    <td>{{ $iustCourse->date_created ? \Carbon\Carbon::parse($iustCourse->date_created)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ التعديل:</th>
                                    <td>{{ $iustCourse->{'date_modified)'} ? \Carbon\Carbon::parse($iustCourse->{'date_modified)'})->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($iustCourse->note)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>ملاحظات</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $iustCourse->note }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- عرض الصلاحيات المرتبطة -->
                    @if($iustCourse->iust_course_intitled->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>الصلاحيات المرتبطة بهذا المقرر</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>الموظف</th>
                                                    <th>رقم القرار الوزاري</th>
                                                    <th>يُدرّس الآن</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($iustCourse->iust_course_intitled as $intitled)
                                                <tr>
                                                    <td>{{ $intitled->employee->first_name ?? '' }} {{ $intitled->employee->last_name ?? '' }}</td>
                                                    <td>{{ $intitled->ministerial_resolution_number }}</td>
                                                    <td>
                                                        @if($intitled->being_taught_now)
                                                            <span class="badge badge-success">نعم</span>
                                                        @else
                                                            <span class="badge badge-secondary">لا</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('iust-courses.edit', $iustCourse) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('iust-courses.destroy', $iustCourse) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المقرر؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection