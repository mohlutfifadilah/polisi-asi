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
                                <h5 class="mb-1">Jawab aduan</h5>
                            </div>
                            <p class="text-muted mb-0">Jawab aduan disini</p>
                            <hr class="my-3">
                        </div>
                        <div class="card-body">
                          @foreach ($allAduan as $s)
                          <ul class="timeline card-timeline mb-4">
                              <li class="timeline-item timeline-item-transparent">
                                  <span class="timeline-point timeline-point-info"></span>
                                  <div class="timeline-event">
                                      <div class="timeline-header mb-1">
                                          <h6 class="mb-2 fw-semibold">{{ $s->aduan }}</h6>
                                          <small
                                              class="text-muted">{{ \Carbon\Carbon::parse($s->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}</small>
                                      </div>
                                      <p class="text-muted mb-2">Admin : {{ $s->response }}</p>
                                  </div>
                              </li>
                          </ul>
                          @endforeach
                            <form action="{{ route('aduan.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_aduan" value="{{ $selectedAduan->id }}">
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="id_subkategori" value="{{ $selectedAduan->id_subkategori }}">
                                <input type="hidden" name="id_status" value="0">
                                <input type="hidden" name="id_role" value="{{ $selectedAduan->id_role }}">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="form-floating form-floating-outline mb-4">
                                      <textarea class="form-control h-px-150" id="exampleFormControlTextarea1" placeholder="Jawab pengaduan disini .."
                                      name="aduan"></textarea>
                                      <label for="exampleFormControlTextarea1">Jawab aduan</label>
                                    </div>
                                    {{-- <div class="mb-3">
                                      <label for="formFile" class="form-label">
                                        <h4>Lampirkan Bukti Aduan</h4>
                                      </label>
                                      <input class="form-control" type="file" id="bukti" name="bukti">
                                    </div> --}}
                                  </div>
                                </div>
                                <input type="hidden" name="bukti" value="{{ $selectedAduan->bukti }}">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Transactions & Report Chart -->

    </div>
@endsection
