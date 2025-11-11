<!-- resources/views/universities/show.blade.php -->
@extends('layouts.master')
@section('title', 'تفاصيل الجامعة')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تفاصيل الجامعة</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">اسم الجامعة:</th>
                                <td>{{ $university->name }}</td>
                            </tr>
                            <tr>
                                <th>تاريخ الإنشاء:</th>
                                <td>
                                    @php
                                        $dateCreated = $university->date_created;
                                        if (is_string($dateCreated)) {
                                            $dateCreated = \Carbon\Carbon::parse($dateCreated);
                                        }
                                    @endphp
                                    {{ $dateCreated ? $dateCreated->format('Y-m-d H:i') : 'غير محدد' }}
                                </td>
                            </tr>
                            <tr>
                                <th>آخر تعديل:</th>
                                <td>
                                    @php
                                        $dateModified = $university->date_modified;
                                        if (is_string($dateModified)) {
                                            $dateModified = \Carbon\Carbon::parse($dateModified);
                                        }
                                    @endphp
                                    {{ $dateModified ? $dateModified->format('Y-m-d H:i') : 'غير محدد' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <a href="{{ route('universities.edit', $university) }}" class="btn btn-primary">
                        <i class="fe fe-edit"></i> تعديل
                    </a>
                    <a href="{{ route('universities.index') }}" class="btn btn-secondary">
                        <i class="fe fe-arrow-right"></i> رجوع للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection