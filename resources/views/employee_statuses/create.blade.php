@extends('layouts.master')
@section('title', 'إضافة حالة موظف جديدة')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة حالة موظف جديدة</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee-statuses.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم الحالة *</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ الإنشاء</label>
                                    <input type="date" name="date_created" class="form-control" 
                                           value="{{ old('date_created') }}">
                                    @error('date_created')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ التعديل</label>
                                    <input type="date" name="date_modified)" class="form-control" 
                                           value="{{ old('date_modified)') }}">
                                    @error('date_modified)')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <a href="{{ route('employee-statuses.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection