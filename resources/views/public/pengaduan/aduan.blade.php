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
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">Formulir Pengaduan</h5>
                            </div>
                            <p class="text-muted mb-0">Isi formulir dibawah ini untuk mengajukan pengaduan</p>
                            <hr class="my-3">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lapor-aduan.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="id_role" value="{{ Auth::user()->id_role }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating form-floating-outline mb-4">
                                            <select class="form-select" id="exampleFormControlSelect1"
                                                aria-label="Default select example" name="id_kategori">
                                                <option selected disabled>Pilih Kategori</option>
                                                @foreach ($subkategori as $s)
                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="exampleFormControlSelect1">Kategori</label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <textarea class="form-control h-px-150" id="exampleFormControlTextarea1" placeholder="Ajukan pengaduan disini .."
                                                name="aduan"></textarea>
                                            <label for="exampleFormControlTextarea1">Aduan</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">
                                                <h4>Lampirkan Bukti Aduan</h4>
                                            </label>
                                            <input class="form-control" type="file" id="bukti" name="bukti">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="col-md-7 col-12 order-2 order-md-0">
          <div class="card-header">
            <h5 class="mb-0">Total Transactions</h5>
          </div>
          <div class="card-body">
            <div id="totalTransactionChart"></div>
          </div>
        </div>
        <div class="col-md-5 col-12 border-start">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5 class="mb-1">Report</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="totalTransaction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical mdi-24px"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalTransaction">
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  <a class="dropdown-item" href="javascript:void(0);">Update</a>
                </div>
              </div>
            </div>
            <p class="text-muted mb-0">Last month transactions $234.40k</p>
          </div>
          <div class="card-body pt-3">
            <div class="row">
              <div class="col-6 border-end">
                <div class="d-flex flex-column align-items-center">
                  <div class="avatar">
                    <div class="avatar-initial bg-label-success rounded">
                      <div class="mdi mdi-trending-up mdi-24px"></div>
                    </div>
                  </div>
                  <p class="text-muted my-2">This Week</p>
                  <h6 class="mb-0 fw-semibold">+82.45%</h6>
                </div>
              </div>
              <div class="col-6">
                <div class="d-flex flex-column align-items-center">
                  <div class="avatar">
                    <div class="avatar-initial bg-label-primary rounded">
                      <div class="mdi mdi-trending-down mdi-24px"></div>
                    </div>
                  </div>
                  <p class="text-muted my-2">This Week</p>
                  <h6 class="mb-0 fw-semibold">-24.86%</h6>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="d-flex justify-content-around">
              <div>
                <p class="text-muted mb-1">Performance</p>
                <h6 class="mb-0 fw-semibold">+94.15%</h6>
              </div>
              <button class="btn btn-primary" type="button">view report</button>
            </div>
          </div>
        </div> --}}
                </div>
            </div>
        </div>
        <!--/ Total Transactions & Report Chart -->
    </div>
@endsection
