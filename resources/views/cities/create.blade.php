@extends('layouts.master')
@section('title', 'إضافة مدينة جديدة')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة مدينة جديدة</h3>
                    <div class="card-tools">
                        <a href="{{ route('cities.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> العودة إلى القائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('cities.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">اسم المدينة *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required 
                                           placeholder="أدخل اسم المدينة">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                      id="note" name="note" rows="4" 
                                      placeholder="أدخل أي ملاحظات هنا">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> حفظ
                            </button>
                            <a href="{{ route('cities.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection