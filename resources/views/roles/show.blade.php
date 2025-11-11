@extends('layouts.master')
@section('title', 'الصلاحيات')

@section('content')
<!-- breadcrumb -->

<!-- row -->
<hr>
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">إدارة النظام</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأدوار / {{ $role->name }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تفاصيل الدور: {{ $role->name }}</h4>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">رجوع</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="avatar avatar-xl bg-{{ $role->name == 'admin' ? 'danger' : ($role->name == 'department_head' ? 'warning' : ($role->name == 'professor' ? 'info' : 'success')) }} mb-3">
                                    <span class="avatar-initials">{{ substr($role->name, 0, 1) }}</span>
                                </div>
                                <h4>{{ $role->name }}</h4>
                                <p class="text-muted">{{ $role->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>المستخدمين بهذا الدور ({{ $role->users_count }})</h5>
                            </div>
                            <div class="card-body">
                                @if(isset($role->users) && $role->users->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>البريد الإلكتروني</th>
                                                    <th>تاريخ التسجيل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($role->users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted text-center">لا يوجد مستخدمين بهذا الدور</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection