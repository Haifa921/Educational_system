@extends('layouts.master')
@section('title', 'تفاصيل التخصص')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل التخصص: {{ $major->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('majors.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم التخصص</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $major->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم التخصص</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $major->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الكلية</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    {{ $major->faculty->name ?? 'غير محدد' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>عدد الموظفين</label>
                                <p class="form-control-plaintext border-bottom pb-2">
                                    <span class="badge badge-info">{{ $major->employees->count() }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <p class="form-control-plaintext border-bottom pb-2">{{ $major->note ?? 'لا توجد ملاحظات' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الإضافة</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $major->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>آخر تحديث</label>
                                <p class="form-control-plaintext border-bottom pb-2">{{ $major->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('majors.destroy', $major->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('هل أنت متأكد من حذف هذا التخصص؟')">
                                <i class="fa fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>

                    <!-- Employees List -->
                    @if($major->employees->count() > 0)
                    <div class="mt-5">
                        <h4 class="card-title">الموظفين في هذا التخصص</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الموظف</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>تاريخ التعيين</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($major->employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->hire_date ? $employee->hire_date->format('Y-m-d') : 'غير محدد' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-4">
                        <i class="fa fa-info-circle"></i> لا يوجد موظفين في هذا التخصص حالياً.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection