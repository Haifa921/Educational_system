@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{ secure_asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@section('title')
إضافة مستخدم جديد - النظام التعليمي
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة مستخدم جديد</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطأ</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">إضافة مستخدم جديد</h3>
                <div class="card-options">
                    <a class="btn btn-secondary btn-sm" href="{{ route('users.index') }}">
                        <i class="fe fe-arrow-right"></i> رجوع لقائمة المستخدمين
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Personal Information Card -->
                        <div class="col-md-6">
                            <div class="card custom-card mb-4">
                                <div class="card-header custom-card-header">
                                    <h5 class="card-title mb-0">المعلومات الشخصية</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="أدخل الاسم الكامل" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="أدخل البريد الإلكتروني" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role & Security Card -->
                        <div class="col-md-6">
                            <div class="card custom-card mb-4">
                                <div class="card-header custom-card-header">
                                    <h5 class="card-title mb-0">الصلاحيات والأمان</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">الدور <span class="text-danger">*</span></label>
                                                <select name="role" class="form-control" required>
                                                    <option value="">-- اختر دور المستخدم --</option>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                                    <option value="department_head" {{ old('role') == 'department_head' ? 'selected' : '' }}>department_head</option>
                                                    <option value="professor" {{ old('role') == 'professor' ? 'selected' : '' }}>professor</option>
                                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>student</option>
                                                </select>
                                                @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Card -->
                    <div class="card custom-card mb-4">
                        <div class="card-header custom-card-header">
                            <h5 class="card-title mb-0">كلمة المرور</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">كلمة المرور <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            كلمة المرور يجب أن تكون至少 8 أحرف.
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="أكد كلمة المرور" required>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role Information Card -->
                    <div class="card custom-card mb-4">
                        <div class="card-header custom-card-header">
                            <h5 class="card-title mb-0">معلومات عن الأدوار</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-danger">
                                            <i class="fe fe-shield"></i>
                                        </div>
                                        <h6 class="info-title">المشرف</h6>
                                        <p class="info-value">صلاحيات كاملة</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-warning">
                                            <i class="fe fe-users"></i>
                                        </div>
                                        <h6 class="info-title">رئيس قسم</h6>
                                        <p class="info-value">إدارة الأقسام</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-info">
                                            <i class="fe fe-book"></i>
                                        </div>
                                        <h6 class="info-title">أستاذ</h6>
                                        <p class="info-value">إدارة المواد</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-success">
                                            <i class="fe fe-user"></i>
                                        </div>
                                        <h6 class="info-title">طالب</h6>
                                        <p class="info-value">الوصول للدروس</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fe fe-user-plus"></i> إضافة المستخدم
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fe fe-x-circle"></i> إلغاء
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Internal Nice-select js-->
<script src="{{ secure_asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ secure_asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize nice select
        $('.nice-select').niceSelect();

        // Password confirmation validation
        $('form').on('submit', function(e) {
            const password = $('input[name="password"]').val();
            const passwordConfirmation = $('input[name="password_confirmation"]').val();
            
            if (password !== passwordConfirmation) {
                e.preventDefault();
                alert('كلمة المرور وتأكيد كلمة المرور غير متطابقين');
                return false;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('كلمة المرور يجب أن تكون至少 8 أحرف');
                return false;
            }
        });

        // Real-time password strength check
        $('input[name="password"]').on('keyup', function() {
            const password = $(this).val();
            const strength = checkPasswordStrength(password);
            updatePasswordStrength(strength);
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            return strength;
        }

        function updatePasswordStrength(strength) {
            const strengthText = ['ضعيفة', 'ضعيفة', 'متوسطة', 'جيدة', 'قوية', 'قوية جداً'];
            const strengthClass = ['danger', 'danger', 'warning', 'info', 'success', 'success'];
            
            $('#password-strength').remove();
            $('input[name="password"]').after(`
                <div id="password-strength" class="mt-1">
                    <small class="text-${strengthClass[strength]}">
                        <i class="fe fe-${strength > 3 ? 'check' : 'alert-circle'}"></i>
                        قوة كلمة المرور: ${strengthText[strength]}
                    </small>
                </div>
            `);
        }
    });
</script>

<style>
.custom-card {
    border: 1px solid #e8ebf1;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 0;
}

.custom-card-header {
    background: linear-gradient(45deg, #f8f9fa, #ffffff);
    border-bottom: 1px solid #e8ebf1;
    padding: 15px 20px;
}

.info-item {
    padding: 15px;
}

.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: white;
    font-size: 20px;
}

.bg-primary { background-color: #467fcf !important; }
.bg-success { background-color: #2bc48a !important; }
.bg-info { background-color: #17a2b8 !important; }
.bg-warning { background-color: #fdb901 !important; }
.bg-danger { background-color: #cd201f !important; }

.info-title {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 5px;
    font-weight: 600;
}

.info-value {
    font-size: 12px;
    color: #495057;
    margin-bottom: 0;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.btn-lg {
    padding: 12px 30px;
    font-size: 16px;
    margin: 0 5px;
}

.form-text {
    font-size: 12px;
}
</style>
@endsection