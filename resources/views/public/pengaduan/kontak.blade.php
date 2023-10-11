@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp
@extends('public/template/master')

@section('title', 'Dinas Sosial Kab. Semarang')
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
                                <h5 class="mb-1">Kontak Aduan</h5>
                            </div>
                            <p class="text-muted mb-0">Beberapa cara untuk kamu mengajukan aduan</p>
                            <hr class="my-3">
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Telepon</dt>
                                <dd class="col-sm-9">xxx</dd>

                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-9">
                                    <p>xxx</p>
                                </dd>
                            </dl>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15835.60840820779!2d110.4066086!3d-7.1373187!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7088a0ebc7f019%3A0x90dd741135bfd0af!2sDinas%20Sosial%20Kab%20Semarang!5e0!3m2!1sid!2sid!4v1695453013704!5m2!1sid!2sid"
                                style="border:0; width: 100%;" height="350" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Transactions & Report Chart -->
    </div>
@endsection
