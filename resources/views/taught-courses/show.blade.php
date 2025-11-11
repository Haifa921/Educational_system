@extends('layouts.master')
@section('title', 'تفاصيل المقرر المدّرس')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المقرر المدّرس</h3>
                    <a href="{{ route('taught-courses.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">الموظف:</th>
                                    <td>{{ $taughtCourse->employee->first_name ?? '' }} {{ $taughtCourse->employee->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>المقرر:</th>
                                    <td>{{ $taughtCourse->course->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>الجامعة:</th>
                                    <td>{{ $taughtCourse->university->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء:</th>
                                    <td>{{ $taughtCourse->date_created ? \Carbon\Carbon::parse($taughtCourse->date_created)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">تاريخ التعديل:</th>
                                    <td>{{ $taughtCourse->{'date_modified)'} ? \Carbon\Carbon::parse($taughtCourse->{'date_modified)'})->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($taughtCourse->note)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>ملاحظات</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $taughtCourse->note }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('taught-courses.edit', $taughtCourse) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('taught-courses.destroy', $taughtCourse) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المقرر المدّرس؟');">
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