@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{secure_asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
المستخدمون
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-1 col-md-2">
                        @can('إضافة مستخدم')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة
                                مستخدم</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50'
                            style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                    <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                                    <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                                    <th class="wd-15p border-bottom-0">نوع المستخدم</th>
                                    <th class="wd-10p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 'مفعل')
                                                <span class="label text-success d-flex">
                                                    <div class="dot-label bg-success ml-1"></div>{{ $user->status }}
                                                </span>
                                            @else
                                                <span class="label text-danger d-flex">
                                                    <div class="dot-label bg-danger ml-1"></div>{{ $user->status }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group"
                                                aria-label="Button group with nested dropdown" style="width:25px;">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        style="background-color:bisque; width:200px; ">
                                                        <div class="dropdown-item">
                                                            @can('تعديل مستخدم')
                                                                <a class="btn btn-primary" style="width:100%;"
                                                                    href="{{ secure_url(route('users.edit', $user->id)) }}">
                                                                    <i class="las la-pen"></i>تعديل المستخدم</a>
                                                            @endcan
                                                        </div>

                                                        <div class="dropdown-item">
                                                            @can('حذف مستخدم')
                                                                <a class="btn btn-primary btn-danger" style="width:100%;"
                                                                    data-user_id="{{ $user->id }}"
                                                                    data-username="{{ $user->name }}" data-toggle="modal"
                                                                    href="#modaldemo8">
                                                                    <i class="las la-trash"></i>حذف المستخدم</a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="delete-form" action="{{ secure_url('users', $user->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <input class="form-control" name="username" id="username" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
