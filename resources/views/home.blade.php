@extends('layouts.master')
@section('title')
     الرئيسية - نظام إداري
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ secure_asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ secure_asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">نظام تعليمي - <i class="fa fa-home"></i> الرئيسية </h2>
                <hr>
            </div>
        </div>

    </div>

    <!-- /breadcrumb -->
@endsection
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@endif

    <!-- row -->
 
@section('content')
<div class="row row-sm">
    <div class="col-12">
        <div class="card">
            <br>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1" style="margin-right:10px;"><i class="fa fa-paper-plane"></i> وصول سريع</h2>
            <hr>
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script >
    $(function () {
         $('[data-toggle="tooltip"]').tooltip()
    })
</script>
    <!--Internal  Chart.bundle js -->
    <script src="{{ secure_asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ secure_asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ secure_asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ secure_asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ secure_asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ secure_asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ secure_asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ secure_asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ secure_asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ secure_asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ secure_asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ secure_asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ secure_asset('assets/js/index.js') }}"></script>
    <script src="{{ secure_asset('assets/js/jquery.vmap.sampledata.js') }}"></script>

@endsection
