@extends('layouts.master')
@section('title', 'تفاصيل الشهادة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل الشهادة</h3>
                    <a href="{{ route('certificates.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">اسم الشهادة:</th>
                                    <td>{{ $certificate->name }}</td>
                                </tr>
                                <tr>
                                    <th>الموظف:</th>
                                    <td>{{ $certificate->employee->first_name ?? '' }} {{ $certificate->employee->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>نوع الشهادة:</th>
                                    <td>{{ $certificate->certificate_type->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>التخصص:</th>
                                    <td>{{ $certificate->certificate_speciliazation->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>البلد:</th>
                                    <td>{{ $certificate->certificate_country->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>عنوان الرسالة:</th>
                                    <td>{{ $certificate->thesis_title ?? '---' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">الشركة:</th>
                                    <td>{{ $certificate->company ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإصدار:</th>
                                    <td>{{ $certificate->release_date ? \Carbon\Carbon::parse($certificate->release_date)->format('Y-m-d') : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>ملف الشهادة:</th>
                                    <td>
                                        @if($certificate->certificate_file)
                                            <a href="{{ route('certificates.download', $certificate) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-download"></i> تحميل الملف
                                            </a>
                                        @else
                                            <span class="text-muted">لا يوجد ملف</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء:</th>
                                    <td>{{ $certificate->date_created ? \Carbon\Carbon::parse($certificate->date_created)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ التعديل:</th>
                                    <td>{{ $certificate->date_modified ? \Carbon\Carbon::parse($certificate->date_modified)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($certificate->description)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>الوصف</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $certificate->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('certificates.edit', $certificate) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('certificates.destroy', $certificate) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الشهادة؟');">
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