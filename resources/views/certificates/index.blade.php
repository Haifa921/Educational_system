@extends('layouts.master')
@section('title', 'الشهادات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الشهادات</h3>
                    <div class="card-tools">
                        <a href="{{ route('certificates.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة شهادة جديدة
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
                                    <th>اسم الشهادة</th>
                                    <th>الموظف</th>
                                    <th>نوع الشهادة</th>
                                    <th>التخصص</th>
                                    <th>البلد</th>
                                    <th>تاريخ الإصدار</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($certificates as $certificate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $certificate->name }}</td>
                                    <td>{{ $certificate->Employee->first_name ?? '' }} {{ $certificate->Employee->last_name ?? '' }}</td>
                                    <td>{{ $certificate->Certificate_Type->name ?? '' }}</td>
                                    <td>{{ $certificate->Certificate_Speciliazation->name ?? '' }}</td> {{-- تم التصحيح --}}
                                    <td>{{ $certificate->Certificate_Country->name ?? '' }}</td>
                                    <td>{{ $certificate->{'release-date'} ? \Carbon\Carbon::parse($certificate->{'release-date'})->format('Y-m-d') : '---' }}</td> {{-- استخدم release-date --}}
                                    <td>
                                        <a href="{{ route('certificates.show', $certificate) }}" 
                                           class="btn btn-info btn-sm" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('certificates.edit', $certificate) }}" 
                                           class="btn btn-warning btn-sm" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($certificate->certificate_file)
                                        <a href="{{ route('certificates.download', $certificate) }}" 
                                           class="btn btn-success btn-sm" title="تحميل الملف">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        @endif
                                        <form action="{{ route('certificates.destroy', $certificate) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الشهادة؟');">
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
                                    <td colspan="8" class="text-center">لا توجد شهادات</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $certificates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection