@extends('layouts.master')
@section('title', '  تفاصيل الموظف الاجنبي')

@section('content')
<hr>
<h1>تفاصيل الموظفين الاجانب</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>رقم:</strong> {{ $foreigner->id }}</li>
    <li class="list-group-item"><strong>رقم جواز السفر:</strong> {{ $foreigner->passport_number }}</li>
    <li class="list-group-item"><strong>تاريخ المنح:</strong> {{ $foreigner->passport_release_date }}</li>
    <li class="list-group-item"><strong>تاريخ الانتهاء:</strong> {{ $foreigner->passport_valid_date }}</li>
    <li class="list-group-item"><strong>رقم الموافقة الامنية:</strong> {{ $foreigner->security_approval_number }}</li>
    <li class="list-group-item"><strong>تاريخ الموافقة الامنية:</strong> {{ $foreigner->security_approval_date }}</li>
    @if ($foreigner->security_approval_image)
        <li class="list-group-item">
            <strong>صورة الموافقة الامنية:</strong><br>
            <img src="{{ asset('storage/'.$foreigner->security_approval_image) }}" alt="Security Image" style="max-width:300px;">
        </li>
    @endif
    <li class="list-group-item"><strong>رقم موافقة العمل:</strong> {{ $foreigner->work_approval_number }}</li>
    <li class="list-group-item"><strong>تاريخ موافقة العمل:</strong> {{ $foreigner->work_approval_date }}</li>
    @if ($foreigner->work_approval_image)
        <li class="list-group-item">
            <strong>صورة موافقة العمل:</strong><br>
            <img src="{{ asset('storage/'.$foreigner->work_approval_image) }}" alt="Work Image" style="max-width:300px;">
        </li>
    @endif
    <li class="list-group-item"><strong>اسم الموظف:</strong> {{ $foreigner->Employee->first_name ?? '—' }}</li>
    <li class="list-group-item"><strong>تاريخ الانشاء:</strong> {{ $foreigner->date_created }}</li>
    <li class="list-group-item"><strong>تاريخ التعديل:</strong> {{ $foreigner->date_modified }}</li>
</ul>

<a href="{{ route('foreigners.index') }}" class="btn btn-secondary mt-3">الرجوع الى القائمة</a>
@endsection