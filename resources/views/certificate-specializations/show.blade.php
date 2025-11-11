@extends('layouts.master')
@section('title', 'تفاصيل تخصص الشهادة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل تخصص الشهادة</h3>
                    <a href="{{ route('certificate-specializations.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">اسم التخصص:</th>
                                    <td>{{ $certificateSpecialization->name }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء:</th>
                                    <td>{{ $certificateSpecialization->date_created ? \Carbon\Carbon::parse($certificateSpecialization->date_created)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ التعديل:</th>
                                    <td>{{ $certificateSpecialization->date_modified ? \Carbon\Carbon::parse($certificateSpecialization->date_modified)->format('Y-m-d H:i') : '---' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('certificate-specializations.edit', $certificateSpecialization) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('certificate-specializations.destroy', $certificateSpecialization) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا التخصص؟');">
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