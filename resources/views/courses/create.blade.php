@extends('layouts.master')
@section('title', 'إضافة مقرر جامعي')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة مقرر جامعي جديد</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> رجوع
                    </a>
                </div>
                <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_created" class="form-label">Date Created</label>
                        <input type="date" class="form-control @error('date_created') is-invalid @enderror" 
                               id="date_created" name="date_created" value="{{ old('date_created') }}" required>
                        @error('date_created')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_modified)" class="form-label">Date Modified</label>
                        <input type="date" class="form-control @error('date_modified)') is-invalid @enderror" 
                               id="date_modified)" name="date_modified)" value="{{ old('date_modified)') }}" required>
                        @error('date_modified)')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection