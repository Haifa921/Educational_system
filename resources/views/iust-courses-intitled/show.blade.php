@extends('layouts.master')
@section('title', 'تفاصيل صلاحية تدريس المقرر')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل صلاحية تدريس المقرر</h3>
                    <a href="{{ route('iust-courses-intitled.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">الموظف:</th>
                                    <td>{{ $iustCourseIntitled->employee->first_name ?? '' }} {{ $iustCourseIntitled->employee->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>المقرر:</th>
                                    <td>{{ $iustCourseIntitled->iust_course->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>رقم القرار الوزاري:</th>
                                    <td>{{ $iustCourseIntitled->ministerial_resolution_number }}</td>
                                </tr>
                                <tr>
                                    <th>يُدرّس الآن:</th>
                                    <td>
                                        @if($iustCourseIntitled->being_taught_now)
                                            <span class="badge badge-success">نعم</span>
                                        @else
                                            <span class="badge badge-secondary">لا</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">تاريخ الإنشاء:</th>
                                    <td>{{ $iustCourseIntitled->date_created ? \Carbon\Carbon::parse($iustCourseIntitled->date_created)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ التعديل:</th>
                                    <td>{{ $iustCourseIntitled->{'date_modified)'} ? \Carbon\Carbon::parse($iustCourseIntitled->{'date_modified)'})->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($iustCourseIntitled->note)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>ملاحظات</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $iustCourseIntitled->note }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('iust-courses-intitled.edit', $iustCourseIntitled) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('iust-courses-intitled.destroy', $iustCourseIntitled) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟');">
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