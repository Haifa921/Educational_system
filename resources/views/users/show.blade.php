@extends('layouts.master')
@section('title', 'عرض  المستخدم')

@section('content')
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المستخدم</h3>
                    <div class="card-options">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fe fe-arrow-right"></i> رجوع
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-header custom-card-header">
                                    <h5 class="card-title mb-0">المعلومات الشخصية</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar avatar-xl bg-primary me-3">
                                            <span class="avatar-initials">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $user->name }}</h6>
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">الاسم الكامل</label>
                                                <div class="form-control-plaintext">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">البريد الإلكتروني</label>
                                                <div class="form-control-plaintext">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">تاريخ التسجيل</label>
                                                <div class="form-control-plaintext">{{ $user->created_at->format('Y-m-d H:i') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <label class="form-label">آخر تحديث</label>
                                                <div class="form-control-plaintext">{{ $user->updated_at->format('Y-m-d H:i') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-header custom-card-header">
                                    <h5 class="card-title mb-0">الصلاحيات والأدوار</h5>
                                </div>
                                <div class="card-body">
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $role)
                                            <div class="mb-3">
                                                <label class="form-label">الدور</label>
                                                <div>
                                                    <span class="badge badge-{{ $role == 'admin' ? 'danger' : ($role == 'department_head' ? 'warning' : ($role == 'professor' ? 'info' : 'success')) }} p-2 fs-12">
                                                        <i class="fe fe-shield me-1"></i>
                                                        {{ $role }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($user->permissions->count() > 0)
                                            <div class="mb-0">
                                                <label class="form-label">الصلاحيات المباشرة</label>
                                                <div>
                                                    @foreach($user->permissions as $permission)
                                                        <span class="badge badge-light mb-1">{{ $permission->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center text-muted">
                                            <i class="fe fe-user-x fs-20"></i>
                                            <p class="mt-2 mb-0">لا توجد أدوار مخصصة</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-header custom-card-header">
                                    <h5 class="card-title mb-0">حالة الحساب</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">حالة البريد الإلكتروني</label>
                                                <div>
                                                    @if($user->email_verified_at)
                                                        <span class="badge badge-success">
                                                            <i class="fe fe-check-circle me-1"></i>
                                                            مفعل
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            <i class="fe fe-x-circle me-1"></i>
                                                            غير مفعل
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">معرف المستخدم</label>
                                                <div class="form-control-plaintext">#{{ $user->id }}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="mb-0">
                                                <label class="form-label">الإجراءات</label>
                                                <div class="d-flex gap-2">
                                                    @can('edit_users')
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                                                        <i class="fe fe-edit"></i> تعديل
                                                    </a>
                                                    @endcan
                                                    
                                                    @can('delete_users')
                                                    @if($user->id !== auth()->id())
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                            <i class="fe fe-trash"></i> حذف
                                                        </button>
                                                    </form>
                                                    @endif
                                                    @endcan
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Card -->
                    {{-- <div class="card custom-card mt-4">
                        <div class="card-header custom-card-header">
                            <h5 class="card-title mb-0">معلومات إضافية</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-primary">
                                            <i class="fe fe-calendar"></i>
                                        </div>
                                        <h6 class="info-title">العضو منذ</h6>
                                        <p class="info-value">{{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-info">
                                            <i class="fe fe-refresh-cw"></i>
                                        </div>
                                        <h6 class="info-title">آخر تحديث</h6>
                                        <p class="info-value">{{ $user->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-success">
                                            <i class="fe fe-shield"></i>
                                        </div>
                                        <h6 class="info-title">عدد الأدوار</h6>
                                        <p class="info-value">{{ $user->getRoleNames()->count() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item text-center">
                                        <div class="info-icon bg-warning">
                                            <i class="fe fe-key"></i>
                                        </div>
                                        <h6 class="info-title">الصلاحيات</h6>
                                        <p class="info-value">{{ $user->getAllPermissions()->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

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

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 18px;
}

.avatar-initials {
    line-height: 1;
}

.bg-primary { background-color: #467fcf !important; }
.bg-success { background-color: #2bc48a !important; }
.bg-info { background-color: #17a2b8 !important; }
.bg-warning { background-color: #fdb901 !important; }

.badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 20px;
}

.badge-danger { background-color: #cd201f; }
.badge-warning { background-color: #fdb901; }
.badge-info { background-color: #17a2b8; }
.badge-success { background-color: #2bc48a; }
.badge-light { 
    background-color: #f8f9fa; 
    color: #495057;
    border: 1px solid #dee2e6;
}

.form-control-plaintext {
    padding: 8px 0;
    border: none;
    background: transparent;
    font-weight: 500;
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

.info-title {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 5px;
}

.info-value {
    font-size: 18px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0;
}

.fs-12 {
    font-size: 12px !important;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}
</style>
@endsection