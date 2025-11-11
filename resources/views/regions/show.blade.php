@extends('layouts.master')
@section('title', 'تفاصيل المنطقة')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المنطقة: {{ $region->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم المنطقة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $region->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم المنطقة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $region->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>المدينة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $region->city->name ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>عدد الموظفين</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    <span class="badge badge-info">{{ $region->employees->count() }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <p class="form-control-plaintext border-bottom pb-2">{{ $region->note ?? 'لا توجد ملاحظات' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الإضافة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $region->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>آخر تحديث</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $region->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('regions.edit', $region->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('regions.destroy', $region->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('هل أنت متأكد من حذف هذه المنطقة؟')">
                                <i class="fa fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection