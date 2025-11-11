@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{ secure_asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@section('title')
تعديل مستخدم - النظام التعليمي
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مستخدم</span>
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

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تعديل بيانات المستخدم</h3>
                <div class="card-options">
                    <a class="btn btn-secondary btn-sm" href="{{ route('users.index') }}">
                        <i class="fe fe-arrow-right"></i> رجوع
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
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
                                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="أدخل الاسم الكامل" required>
                                                @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="أدخل البريد الإلكتروني" required>
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
                                                    <option value="admin" {{ $user->role_name == 'admin' ? 'selected' : '' }}>admin</option>
                                                    <option value="department_head" {{ $user->role_name == 'department_head' ? 'selected' : '' }}>department_head</option>
                                                    <option value="professor" {{ $user->role_name == 'professor' ? 'selected' : '' }}>professor</option>
                                                    <option value="student" {{ $user->role_name == 'student' ? 'selected' : '' }}>student</option>
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

                    <!-- Password Update Card -->
                    <div class="card custom-card mb-4">
                        <div class="card-header custom-card-header">
                            <h5 class="card-title mb-0">تغيير كلمة المرور</h5>
                            <small class="text-muted">اترك الحقول فارغة إذا لم ترد تغيير كلمة المرور</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">كلمة المرور الجديدة</label>
                                        <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور الجديدة">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">تأكيد كلمة المرور</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="أكد كلمة المرور الجديدة">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current User Info -->
                    <div class="card custom-card mb-4">
                        <div class="card-header custom-card-header">
                            <h5 class="card-title mb-0">معلومات الحساب الحالية</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-primary">
                                            <i class="fe fe-user"></i>
                                        </div>
                                        <h6 class="info-title">معرف المستخدم</h6>
                                        <p class="info-value">#{{ $user->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-info">
                                            <i class="fe fe-calendar"></i>
                                        </div>
                                        <h6 class="info-title">تاريخ التسجيل</h6>
                                        <p class="info-value">{{ $user->created_at->format('Y-m-d') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-success">
                                            <i class="fe fe-shield"></i>
                                        </div>
                                        <h6 class="info-title">الدور الحالي</h6>
                                        <p class="info-value">
                                            <span class="badge badge-{{ $user->role_name == 'admin' ? 'danger' : ($user->role_name == 'department_head' ? 'warning' : ($user->role_name == 'professor' ? 'info' : 'success')) }}">
                                                {{ $user->role_name }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-warning">
                                            <i class="fe fe-mail"></i>
                                        </div>
                                        <h6 class="info-title">حالة البريد</h6>
                                        <p class="info-value">
                                            @if($user->email_verified_at)
                                                <span class="badge badge-success">مفعل</span>
                                            @else
                                                <span class="badge badge-danger">غير مفعل</span>
                                            @endif
                                        </p>
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
                                    <i class="fe fe-check-circle"></i> تحديث البيانات
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

        // Form validation
        $('form').on('submit', function(e) {
            const password = $('input[name="password"]').val();
            const passwordConfirmation = $('input[name="password_confirmation"]').val();
            
            if (password !== passwordConfirmation) {
                e.preventDefault();
                alert('كلمة المرور وتأكيد كلمة المرور غير متطابقين');
                return false;
            }
        });
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

.info-title {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 5px;
}

.info-value {
    font-size: 16px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0;
}

.badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 20px;
}

.badge-danger { background-color: #cd201f; }
.badge-warning { background-color: #fdb901; }
.badge-info { background-color: #17a2b8; }
.badge-success { background-color: #2bc48a; }

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
</style>
@endsection