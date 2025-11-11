@extends('layouts.master')
@section('title', 'الصلاحيات')

@section('content')
<!-- breadcrumb -->

<!-- row -->
<hr>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">أدوار المستخدمين في النظام</h4>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('info'))
                    <div class="alert alert-info">{{ session('info') }}</div>
                @endif

                <div class="row">
                    @foreach($roles as $role)
                        @if(in_array($role->name, ['admin', 'department_head']))
                        <div class="col-md-6 col-lg-3">
                            <div class="card custom-card">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-lg bg-{{ $role->name == 'admin' ? 'danger' : 'warning' }} mb-3">
                                        <span class="avatar-initials">{{ substr($role->name, 0, 1) }}</span>
                                    </div>
                                    <h5 class="card-title">{{ $role->name }}</h5>
                                    <p class="text-muted">{{ $role->description }}</p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <span class="text-muted">عدد المستخدمين:</span>
                                        <span class="font-weight-bold">{{ $role->users_count }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fe fe-eye"></i> عرض التفاصيل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <div class="alert alert-info mt-4">
                    <h6>ملاحظة:</h6>
                    <p class="mb-0">لإدارة أدوار المستخدمين، يرجى الذهاب إلى <a href="{{ route('users.index') }}">صفحة المستخدمين</a> وتعديل دور كل مستخدم بشكل فردي.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

<style>
.avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 20px;
    margin: 0 auto;
}

.avatar-initials {
    line-height: 1;
}

.bg-danger { background-color: #cd201f !important; }
.bg-warning { background-color: #fdb901 !important; }

.custom-card {
    border: 1px solid #e8ebf1;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}
</style>