@extends('layouts.master')
@section('title', 'تفاصيل الكلية')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل الكلية: {{ $faculty->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('faculties.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم الكلية</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $faculty->极速赛车开奖直播id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم الكلية</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $faculty->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>عدد التخصصات</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    <span class="badge badge-info">{{ $faculty->Major ->count() }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الإضافة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $faculty->created_at->format('Y-m-d H:i') }}</p>
                            </极速赛车开奖直播div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <p class="form-control-plaintext border-bottom pb-2">{{ $faculty->note ?? 'لا توجد ملاحظات' }}</p>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('هل أنت متأكد من حذف هذه الكلية؟')">
                                <i class="fa fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>

                    <!-- Major  List -->
                    @if($faculty->Major ->count() > 0)
                    <div class="mt-5">
                        <h4 class="card-title">التخصصات التابعة لهذه الكلية</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم التخصص</th>
                                        <th>ملاحظات</th>
                                        <th>عدد الموظفين</th>
                                        <th>تاريخ الإضافة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faculty->Major  as $major)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $major->name }}</td>
                                        <td>{{ $major->note ? \Illuminate\Support\Str::limit($major->note, 50) : 'لا توجد ملاحظات' }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $major->employees_count ?? 0 }}</span>
                                        </td>
                                        <td>{{ $major->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-4">
                        <i class="fa fa-info-circle"></i> لا توجد تخصصات تابعة لهذه الكلية حالياً.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection