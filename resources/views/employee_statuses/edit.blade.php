@extends('layouts.master')
@section('title', 'تعديل حالة الموظف')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل حالة الموظف: {{ $employeeStatus->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee-statuses.update', $employeeStatus->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم الحالة *</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name', $employeeStatus->name) }}" required>
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
                                    <input type="date" name="date_careted" class="form-control" 
                                           value="{{ old('date_careted', $employeeStatus->date_careted) }}">
                                    @error('date_careted')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ التعديل</label>
                                    <input type="date" name="date_modified" class="form-control" 
                                           value="{{ old('date_modified', $employeeStatus->date_modified) }}">
                                    @error('date_modified')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">تحديث</button>
                            <a href="{{ route('employee-statuses.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection