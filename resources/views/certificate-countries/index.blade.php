@extends('layouts.master')
@section('title', 'بلدان الشهادات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بلدان الشهادات</h3>
                    <div class="card-tools">
                        <a href="{{ route('certificate-countries.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة بلد جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم البلد</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->note ?? '---' }}</td>
                                    <td>{{ $country->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('certificate-countries.show', $country) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('certificate-countries.edit', $country) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('certificate-countries.destroy', $country) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا البلد؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد بلدان</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection