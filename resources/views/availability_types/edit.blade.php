@extends('layouts.master')
@section('title', 'تعديل نوع التوفر')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل نوع التوفر: {{ $availabilityType->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('availability-types.update', $availabilityType->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم نوع التوفر *</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name', $availabilityType->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>عدد الساعات *</label>
                                    <input type="number" name="hours_count" class="form-control" 
                                           value="{{ old('hours_count', $availabilityType->hours_count) }}" min="0" required>
                                    @error('hours_count')
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
                                           value="{{ old('date_created', $availabilityType->date_created) }}">
                                    @error('date_created')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ التعديل</label>
                                    <input type="date" name="date_modified" class="form-control" 
                                           value="{{ old('date_modified', $availabilityType->date_modified) }}">
                                    @error('date_modified')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">تحديث</button>
                            <a href="{{ route('availability-types.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection