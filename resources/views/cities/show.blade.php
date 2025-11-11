@extends('layouts.master')
@section('title', 'تفاصيل المدينة')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المدينة: {{ $city->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('cities.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم المدينة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $city->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم المدينة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $city->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>عدد المناطق</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    <span class="badge badge-info">{{ $city->Region_count }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الإضافة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $city->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <p class="form-control-plaintext border-bottom pb-2">{{ $city->note ?? 'لا توجد ملاحظات' }}</p>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('هل أنت متأكد من حذف هذه المدينة؟')">
                                <i class="fa fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>

                    <!-- Region List -->
                    @if($city->Region->count() > 0)
                    <div class="mt-5">
                        <h4 class="card-title">المناطق التابعة لهذه المدينة</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المنطقة</th>
                                        <th>ملاحظات</th>
                                        <th>تاريخ الإضافة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($city->Region as $region)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $region->name }}</td>
                                        <td>{{ $region->note ? \Illuminate\Support\Str::limit($region->note, 50) : 'لا توجد ملاحظات' }}</td>
                                        <td>{{ $region->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-4">
                        <i class="fa fa-info-circle"></i> لا توجد مناطق تابعة لهذه المدينة حالياً.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection