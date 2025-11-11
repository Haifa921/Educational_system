@extends('layouts.master')
@section('title', 'تفاصيل بلد الشهادة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل بلد الشهادة</h3>
                    <a href="{{ route('certificate-countries.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">اسم البلد:</th>
                                    <td>{{ $certificateCountry->name }}</td>
                                </tr>
                                <tr>
                                    <th>ملاحظات:</th>
                                    <td>{{ $certificateCountry->note ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء:</th>
                                    <td>{{ $certificateCountry->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ التحديث:</th>
                                    <td>{{ $certificateCountry->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('certificate-countries.edit', $certificateCountry) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('certificate-countries.destroy', $certificateCountry) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا البلد؟');">
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