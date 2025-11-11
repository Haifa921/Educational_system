@extends('layouts.master')
@section('title', 'إضافة موظف جديد')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة موظف جديد</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم الأول *</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم الأخير *</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم الأم</label>
                                    <input type="text" name="mother_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>اسم الأب</label>
                                    <input type="text" name="father_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الرقم الوطني *</label>
                                    <input type="text" name="national_number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الجنسية</label>
                                    <input type="text" name="nationality" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ الميلاد *</label>
                                    <input type="date" name="birth_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>مكان الميلاد</label>
                                    <input type="text" name="birth_place" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الجنس *</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المسمى الوظيفي *</label>
                                    <select name="position_id" class="form-control" required>
                                        <option value="">اختر المسمى الوظيفي</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المنطقة *</label>
                                    <select name="region_id" class="form-control" required>
                                        <option value="">اختر المنطقة</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>التخصص *</label>
                                    <select name="major_id" class="form-control" required>
                                        <option value="">اختر التخصص</option>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}">{{ $major->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="general_specialization">التخصص العام *</label>
                                <input type="text" class="form-control @error('general_specialization') is-invalid @enderror" 
                                       id="general_specialization" name="general_specialization" 
                                       value="{{ old('general_specialization') }}" required 
                                       placeholder="أدخل التخصص العام">
                                @error('general_specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="detailed_specialization">تفاصيل التخصص العام *</label>
                                    <input type="text" class="form-control @error('detailed_specialization') is-invalid @enderror" 
                                           id="detailed_specialization" name="detailed_specialization" 
                                           value="{{ old('detailed_specialization') }}" required 
                                           placeholder="أدخل تفاصيل التخصص العام">
                                    @error('detailed_specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">  <div class="form-group">
                                <label for="scientific_rank">المعدل العلمي   *</label>
                                <input type="text" class="form-control @error('scientific_rank') is-invalid @enderror" 
                                       id="scientific_rank" name="scientific_rank" 
                                       value="{{ old('scientific_rank') }}" required 
                                       placeholder="أدخل  المعدل العلمي">
                                @error('scientific_rank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div></div>
                            <div class="col-md-6"> <div class="form-group">
                                <label for="scientific_rank_obtaining_date">تاريخ الحصول على المعدل العلمي   *</label>
                                <input type="date" class="form-control @error('scientific_rank_obtaining_date') is-invalid @enderror" 
                                       id="scientific_rank_obtaining_date" name="scientific_rank_obtaining_date" 
                                       value="{{ old('scientific_rank_obtaining_date') }}" required 
                                       placeholder="أدخل  المعدل العلمي">
                                @error('scientific_rank_obtaining_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div></div>
                            <div class="col-md-6"> <div class="form-group">
                                <label for="affiliated_government_agency">وكالة حكومية تابعة   *</label>
                                <input type="text" class="form-control @error('affiliated_government_agency') is-invalid @enderror" 
                                       id="affiliated_government_agency" name="affiliated_government_agency" 
                                       value="{{ old('affiliated_government_agency') }}" required 
                                       placeholder="أدخل  الوكالة الحكومية التابعة لها">
                                @error('affiliated_government_agency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_contracted" 
                                               name="is_contracted" value="1" 
                                               {{ old('is_contracted', isset($employee) ? $employee->is_contracted : false) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_contracted">
                                            موظف بعقد
                                        </label>
                                    </div>
                                    @error('is_contracted')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="availability_days_count">عدد أيام التفرغ</label>
                                <input type="number" step="0.01" class="form-control @error('availability_days_count') is-invalid @enderror" 
                                       id="availability_days_count" name="availability_days_count" 
                                       value="{{ old('availability_days_count', $employee->availability_days_count ?? '') }}" 
                                       placeholder="أدخل عدد أيام التفرغ" min="0" max="365">
                                <small class="form-text text-muted">يمكنك استخدام الكسور العشرية (مثال: 2.5)</small>
                                @error('availability_days_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="availability_hours_count">عدد أيام التفرغ</label>
                                    <input type="number" step="0.01" class="form-control @error('availability_hours_count') is-invalid @enderror" 
                                           id="availability_hours_count" name="availability_hours_count" 
                                           value="{{ old('availability_hours_count', $employee->availability_hours_count ?? '') }}" 
                                           placeholder="أدخل عدد أيام التفرغ" min="0" max="365">
                                    <small class="form-text text-muted">يمكنك استخدام الكسور العشرية (مثال: 2.5)</small>
                                    @error('availability_hours_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div></div>
                        </div>
                      
                     
                      
                       
                       
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الحالة *</label>
                                    <select name="status_id" class="form-control" required>
                                        <option value="">اختر الحالة</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>صورة شخصية</label>
                                    <input type="file" name="personal_image" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>صورة الهوية</label>
                                    <input type="file" name="id_image" class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 