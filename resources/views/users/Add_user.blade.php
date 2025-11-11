@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{secure_asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
اضافة مستخدم - مورا سوفت للادارة القانونية
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>إضافة مستخدم جديد</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>خطأ!</strong> هناك بعض المشاكل في المدخلات.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">اسم المستخدم:</label>
                                    <input type="text" name="username" class="form-control" placeholder="ادخل اسم المستخدم" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">صلاحية المستخدم:</label>
                                    <input type="text" name="name" class="form-control" placeholder="ادخل اسم المستخدم" value="{{ old('name') }}" required>
                                </div> 
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">البريد الإلكتروني:</label>
                                    <input type="email" name="email" class="form-control" placeholder="ادخل البريد الإلكتروني" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">كلمة المرور:</label>
                                    <input type="password" name="password" class="form-control" placeholder="ادخل كلمة المرور" required>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">تأكيد كلمة المرور:</label>
                                    <input type="password" name="confirm-password" class="form-control" placeholder="اعد ادخال كلمة المرور" required>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="required-field">نوع المستخدم:</label>
                                    <select name="roles_name" class="form-control" required>
                                        <option value="">--اختر نوع المستخدم--</option>
                                        @foreach($roles as $key => $value)
                                            <option value="{{ $key }}" {{ old('roles_name') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>حالة المستخدم:</label>
                                    <select name="status" class="form-control">
                                        <option value="مفعل" {{ old('status') == 'مفعل' ? 'selected' : '' }}>مفعل</option>
                                        <option value="غير مفعل" {{ old('status') == 'غير مفعل' ? 'selected' : '' }}>غير مفعل</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save me-1"></i>حفظ</button>
                                <a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="fas fa-arrow-left me-1"></i> رجوع</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & jQuery JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // التحقق من تطابق كلمات المرور
        $('form').submit(function(e) {
            var password = $('input[name="password"]').val();
            var confirmPassword = $('input[name="confirm-password"]').val();
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('كلمات المرور غير متطابقة!');
                return false;
            }
            return true;
        });
    });
</script>

@endsection
