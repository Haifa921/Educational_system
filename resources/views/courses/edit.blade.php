@extends('layouts.master')
@section('title', 'تعديل مقرر جامعي')

@section('content')
<hr>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2>تعديل المقرر</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المقرر</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $course->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_created" class="form-label">تاريخ الانشاء</label>
                        <input type="date" class="form-control @error('date_created') is-invalid @enderror" 
                               id="date_created" name="date_created" 
                               value="{{ old('date_created', $course->date_created instanceof \Carbon\Carbon ? $course->date_created->format('Y-m-d') : $course->date_created) }}"   required>
                        @error('date_created')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_modified)" class="form-label">تاريخ التعديل </label>
                        <input type="date" class="form-control @error('date_modified)') is-invalid @enderror" 
                               id="date_modified)" name="date_modified)" 
                               value="{{ old('date_modified', \Carbon\Carbon::parse($course->date_modified)->format('Y-m-d')) }}" 
                               required>
                        @error('date_modified)')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">تعديل المقرر</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection