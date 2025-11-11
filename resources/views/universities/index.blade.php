<!-- resources/views/universities/index.blade.php -->
@extends('layouts.master')
@section('title', 'الجامعات')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">قائمة الجامعات</h3>
                <a href="{{ route('universities.create') }}" class="btn btn-primary btn-sm float-right">
                    <i class="fe fe-plus"></i> إضافة جامعة جديدة
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الجامعة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>آخر تعديل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($universities as $university)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $university->name }}</td>
                                <td>
                                    @if($university->date_created instanceof \Carbon\Carbon)
                                        {{ $university->date_created->format('Y-m-d H:i') }}
                                    @elseif(is_string($university->date_created))
                                        {{ \Carbon\Carbon::parse($university->date_created)->format('Y-m-d H:i') }}
                                    @else
                                        {{ $university->date_created ?? 'غير محدد' }}
                                    @endif
                                </td>
                                <td>
                                    @if($university->date_modified instanceof \Carbon\Carbon)
                                        {{ $university->date_modified->format('Y-m-d H:i') }}
                                    @elseif(is_string($university->date_modified))
                                        {{ \Carbon\Carbon::parse($university->date_modified)->format('Y-m-d H:i') }}
                                    @else
                                        {{ $university->date_modified ?? 'غير محدد' }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('universities.show', $university) }}" class="btn btn-info btn-sm" title="عرض">
                                        <i class="fe fe-eye"></i>
                                    </a>
                                    <a href="{{ route('universities.edit', $university) }}" class="btn btn-primary btn-sm" title="تعديل">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <form action="{{ route('universities.destroy', $university) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه الجامعة؟')">
                                            <i class="fe fe-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $universities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection