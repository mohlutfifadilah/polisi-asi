@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp
@extends('public/template/master')

@section('title', 'Detail Aduan')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row gy-4">
        <!-- Total Transactions & Report Chart -->
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">Detail Aduan</h5>
                            </div>
                            <p class="text-muted mb-0">Lihat aduan disini</p>
                            <hr class="my-3">
                        </div>
                        <div class="card-body pb-1">
                            <ul class="timeline card-timeline mb-3">
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-danger"></span>
                                        @php
                                            $subkategori = \App\Models\Subkategori::find($aduan->id_subkategori);
                                        @endphp
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-2 fw-semibold">{{ $subkategori->name }}</h6>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($aduan->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}</small>
                                            </div>
                                            <p class="text-justify mb-1 mt-2">{{ $aduan->aduan }}</p>
                                            <p class="text-muted mb-2">{{ $aduan->response }}</p>
                                        </div>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
