@extends('admin/template/master')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-ecommerce.js') }}"></script>
@endsection

@section('content')
    <div class="row gy-4 mb-4">
        <!-- Aduan Masuk -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-2">Aduan Masuk</h4>
                        {{-- <div class="dropdown">
            <button class="btn p-0" type="button" id="salesOverview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesOverview">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="me-2">Total {{ \App\Models\Aduan::where('id_aduan', null)->count() }}</small>
                        {{-- <div class="d-flex align-items-center text-success">
            <p class="mb-0">+18%</p>
            <i class="mdi mdi-chevron-up"></i>
          </div> --}}
                    </div>
                </div>
                <div class="card-body d-flex justify-content-between flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-danger rounded">
                                <i class="mdi mdi-comment-alert-outline mdi-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h4 class="mb-0">
                                {{ \App\Models\Aduan::where('id_aduan', null)->where('id_role', 2)->count() }}</h4>
                            <small class="text-muted">Belum terdisposisi</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <i class="mdi mdi-progress-alert mdi-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h4 class="mb-0">
                                {{ \App\Models\Aduan::where('id_aduan', null)->where(function ($query) {
                                        $query->where('id_role', 3)->where('id_status', 0);
                                    })->orWhere(function ($query) {
                                        $query->where('id_role', 4)->where('id_status', 0);
                                    })->orWhere(function ($query) {
                                        $query->where('id_role', 6)->where('id_status', 0);
                                    })->count() }}
                            </h4>
                            <small class="text-muted">Belum direspon</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-success rounded">
                                <i class="mdi mdi-alert-circle-outline mdi-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h4 class="mb-0">
                                {{ \App\Models\Aduan::where('id_aduan', null)->where('id_status', 1)->count() }}</h4>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Aduan Masuk -->

        <!-- Ratings -->
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
                                <h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap">Masuk</h5>
                                <div class="badge bg-label-danger rounded-pill lh-xs">
                                    {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->locale('id')->isoFormat('MMMM YYYY') }}
                                </div>
                            </div>
                            <div class="d-flex align-items-end flex-wrap gap-1">
                                <h4 class="mb-0 me-2">
                                    {{ \App\Models\Aduan::whereYear('created_at', \Carbon\Carbon::now()->year)->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('id_aduan', null)->where('id_status', 0)->count() }}
                                </h4>
                                <small>Aduan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-end d-flex align-items-end justify-content-center">
                        <div class="card-body pb-0 pt-3 position-absolute bottom-0">
                            <img src="{{ asset('assets/img/illustrations/card-ratings-illustration.png') }}" alt="Ratings"
                                width="95">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Ratings -->

        <!-- Sessions -->
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
                                <h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap">Selesai</h5>
                                <div class="badge bg-label-success rounded-pill lh-xs">
                                    {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->locale('id')->isoFormat('MMMM YYYY') }}
                                </div>
                            </div>
                            <div class="d-flex align-items-end flex-wrap gap-1">
                                <h4 class="mb-0 me-2">
                                    {{ \App\Models\Aduan::whereYear('created_at', \Carbon\Carbon::now()->year)->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('id_aduan', null)->where('id_status', 1)->count() }}
                                </h4>
                                <small>Aduan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-end d-flex align-items-end justify-content-center">
                        <div class="card-body pb-0 pt-3 position-absolute bottom-0">
                            <img src="{{ asset('assets/img/illustrations/card-session-illustration.png') }}" alt="Ratings"
                                width="81">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Sessions -->

        <!-- Weekly Sales with bg-->
        <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper text-bg-primary"
                id="swiper-weekly-sales-with-bg">
                <div class="swiper-wrapper">
                    @foreach ($pelayanan as $p)
                        @php
                            $subkategori = \App\Models\Pelayanan::find($p->id_subkategori);
                        @endphp
                        <div class="swiper-slide">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-white mb-2">Alur Pelayanan</h5>
                                    <div class="d-flex align-items-center gap-2">
                                        <small>Total {{ \App\Models\Pelayanan::count() }} Pelayanan</small>
                                        {{-- <div class="d-flex text-success">
                                        <small class="fw-medium">+62%</small>
                                        <i class="mdi mdi-chevron-up"></i>
                                    </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                        <h6 class="text-white mt-0 mt-md-3 mb-3 py-1">Aduan</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mb-3 align-items-center">
                                                        <p class="mb-0 me-2 weekly-sales-text-bg-primary">
                                                            {{ \App\Models\Aduan::where('id_subkategori', $p->id_subkategori)->where('id_aduan', null)->where('id_role', 2)->where('id_status', 0)->count() }}
                                                        </p>
                                                        <p class="mb-0">Masuk</p>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <p class="mb-0 me-2 weekly-sales-text-bg-primary">
                                                            {{ \App\Models\Aduan::where('id_subkategori', $p->id_subkategori)->where('id_aduan', null)->where(function ($query) {
                                                                    $query->where('id_role', 3)->where('id_status', 0);
                                                                })->orWhere(function ($query) {
                                                                    $query->where('id_role', 4)->where('id_status', 0);
                                                                })->orWhere(function ($query) {
                                                                    $query->where('id_role', 6)->where('id_status', 0);
                                                                })->count() }}
                                                        </p>
                                                        <p class="mb-0">Disposisi</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mb-3 align-items-center">
                                                        <p class="mb-0 me-2 weekly-sales-text-bg-primary">
                                                            {{ \App\Models\Aduan::where('id_subkategori', $p->id_subkategori)->where('id_aduan', null)->where(function ($query) {
                                                                    $query->where('id_role', 3)->where('id_status', 0);
                                                                })->orWhere(function ($query) {
                                                                    $query->where('id_role', 4)->where('id_status', 0);
                                                                })->orWhere(function ($query) {
                                                                    $query->where('id_role', 6)->where('id_status', 0);
                                                                })->where('response', '!=', null)->count() }}
                                                        </p>
                                                        <p class="mb-0">Proses</p>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <p class="mb-0 me-2 weekly-sales-text-bg-primary">
                                                            {{ \App\Models\Aduan::where('id_subkategori', $p->id_subkategori)->where('id_aduan', null)->where('id_role', 2)->where('id_status', 1)->count() }}
                                                        </p>
                                                        <p class="mb-0">Selesai</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-2 my-md-0 text-center">
                                        <a href="{{ $p->url }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('storage/pelayanan/' . $p->image) }}" alt="weekly sales"
                                                width="180" class="weekly-sales-img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="swiper-pagination"></div> --}}
            </div>
        </div>
        <!--/ Weekly Sales with bg-->

        <!--Aduan tahun ini -->
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Aduan
                        {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->locale('id')->isoFormat('YYYY') }}</h5>
                </div>
                <div class="card-body">
                    <div class="card-info">
                        <p class="text-muted mb-2">Total Aduan tahun ini</p>
                        <h5 class="mb-0">
                            {{ \App\Models\Aduan::whereYear('created_at', \Carbon\Carbon::now()->year)->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('id_aduan', null)->count() }}
                        </h5>
                    </div>
                    <div id="saleThisMonth"></div>
                </div>
            </div>
        </div>
        <!--/Aduan tahun ini -->

    </div>
    <div class="row gy-4 mb-4">
        <!-- Aduan Terbaru -->
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Aduan Terbaru</h5>
                    </div>
                </div>
                <div class="card-body pt-4 pb-2 mt-2">
                    <ul class="timeline card-timeline mb-0">
                        @foreach ($aduan as $a)
                            @php
                                $subkategori = \App\Models\Subkategori::find($a->id_subkategori);
                            @endphp
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-danger"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-2 fw-semibold">{{ $subkategori->name }}</h6>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($a->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</small>
                                    </div>
                                    <p class="text-muted mb-2">{{ $a->aduan }}</p>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="me-3">
                                            <img src="{{ asset('storage/aduan/' . $a->bukti) }}" alt="Bukti"
                                                width="100" class="mx-auto">
                                            {{-- <span class="fw-semibold text-muted">invoices.pdf</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Aduan Terbaru -->

        <!-- Top Referral Source  -->
        {{-- <div class="col-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title m-0">
                        <h5 class="mb-0">Kategori</h5>
                        <small class="text-muted">82% Activity Growth</small>
                    </div>
                </div>
                <div class="card-body pb-1">
                    <ul class="nav nav-tabs nav-tabs-widget pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                        @foreach ($kategori as $key => $k)
                            <li class="nav-item">
                                <a href="javascript:void(0);"
                                    class="nav-link btn {{ $key === 0 ? 'active' : '' }} d-flex flex-column align-items-center justify-content-center"
                                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-{{ $k->name }}"
                                    aria-controls="navs-{{ $k->name }}" aria-selected="true">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-secondary rounded">
                                            {{ $k->name }}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content p-0 ms-0 ms-sm-2">
                            <div class="tab-pane fade show active" id="navs-PPSKS" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="ps-0 fw-medium text-heading">Bidang</th>
                                                <th class="fw-medium ps-0 text-heading">Masuk</th>
                                                <th class="pe-0 fw-medium text-end text-heading">Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subkategori as $s)
                                              @php
                                                $count_masuk = \App\Models\Aduan::where('id_subkategori', 1)->where('id_aduan', null)->where('id_status', 0)->count();
                                                $count_selesai = \App\Models\Aduan::where('id_subkategori', 1)->where('id_aduan', null)->where('id_status', 1)->count();
                                                $bidang1 = \App\Models\Subkategori::where('id_kategori', 1)->get();
                                              @endphp
                                                <tr>
                                                    <td class="ps-0">
                                                        {{ $bidang1->name }}
                                                    </td>
                                                    <td class="text-heading text-end pe-0 fw-semibold">{{ $count_masuk }}</td>
                                                    <td class="pe-0 text-end fw-semibold h6 text-success">{{ $count_selesai }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="tab-content p-0 ms-0 ms-sm-2">
                            <div class="tab-pane fade show active" id="navs-PPMKS" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="ps-0 fw-medium text-heading">Bidang</th>
                                                <th class="fw-medium ps-0 text-heading">Masuk</th>
                                                <th class="pe-0 fw-medium text-end text-heading">Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subkategori as $s)
                                              @php
                                                $count_masuk = \App\Models\Aduan::where('id_subkategori', 2)->where('id_aduan', null)->where('id_status', 0)->count();
                                                $count_selesai = \App\Models\Aduan::where('id_subkategori', 2)->where('id_aduan', null)->where('id_status', 1)->count();
                                                $bidang2 = \App\Models\Subkategori::where('id_kategori', 2)->get();
                                              @endphp
                                                <tr>
                                                    <td class="ps-0">
                                                        {{ $s->name }}
                                                    </td>
                                                    <td class="text-heading text-end pe-0 fw-semibold">{{ $count_masuk }}</td>
                                                    <td class="pe-0 text-end fw-semibold h6 text-success">{{ $count_selesai }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--/ Top Referral Source  -->

        {{-- <!-- Total Impression & Order Chart -->
        <div class="col-lg-3 col-sm-6 order-sm-1 order-lg-0">
            <div class="card">
                <div class="card-body pb-0 pt-3">
                    <div class="row d-flex align-items-center">
                        <div class="col-5 col-lg-6 col-xl-5">
                            <div class="chart-progress" data-color="primary" data-series="70"
                                data-icon="../../assets/img/icons/misc/card-icon-laptop.png"></div>
                        </div>
                        <div class="col-7 col-lg-6 col-xl-7">
                            <div class="card-info">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h5 class="mb-0">84k</h5>
                                    <div class="d-flex  text-danger">
                                        <p class="mb-0">-24%</p>
                                        <div class="mdi mdi-chevron-down"></div>
                                    </div>
                                </div>
                                <p class="mb-0 mt-1">Total Impression</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-2">
                <div class="card-body pt-0 pb-3">
                    <div class="row d-flex align-items-center">
                        <div class="col-5 col-lg-6 col-xl-5">
                            <div class="chart-progress" data-color="warning" data-series="40"
                                data-icon="../../assets/img/icons/misc/card-icon-bag.png"></div>
                        </div>
                        <div class="col-7 col-lg-6 col-xl-7">
                            <div class="card-info">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h5 class="mb-0">22k</h5>
                                    <div class="d-flex  text-success">
                                        <p class="mb-0">+15%</p>
                                        <div class="mdi mdi-chevron-up"></div>
                                    </div>
                                </div>
                                <p class="mb-0 mt-1">Total Order</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Impression & Order Chart -->

        <!-- Marketing & Sales-->
        <div class="col-lg-5">
            <div class="swiper-container swiper-container-horizontal swiper swiper-sales" id="swiper-marketing-sales">
                <div class="swiper-wrapper">
                    <div class="swiper-slide pb-3">
                        <h5 class="mb-2">Marketing & Sales</h5>
                        <div class="d-flex align-items-center gap-2">
                            <small>Total 245.8k Sales</small>
                            <div class="d-flex text-success">
                                <small class="fw-medium">+25%</small>
                                <i class="mdi mdi-chevron-up"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <img src="{{ asset('assets//img/products/card-marketing-expense-logo.png') }}"
                                alt="Marketing and sales" width="84" class="rounded">
                            <div class="d-flex flex-column w-100 ms-4">
                                <h6 class="mb-3">Marketing Expense</h6>
                                <div class="row d-flex flex-wrap justify-content-between">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">5k</small>
                                                <small class="mb-0 text-truncate">Operating</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">6k</small>
                                                <small class="mb-0 text-truncate">COGF</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">2k</small>
                                                <small class="mb-0 text-truncate">Financial</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">1k</small>
                                                <small class="mb-0 text-truncate">Expense</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-1">
                            <button type="button" class="btn btn-sm btn-outline-primary me-3">Details</button>
                            <button type="button" class="btn btn-sm btn-primary">Report</button>
                        </div>
                    </div>
                    <div class="swiper-slide pb-3">
                        <h5 class="mb-2">Marketing & Sales</h5>
                        <div class="d-flex align-items-center gap-2">
                            <small>Total 245.8k Sales</small>
                            <div class="d-flex text-success">
                                <small class="fw-medium">+25%</small>
                                <i class="mdi mdi-chevron-up"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <img src="{{ asset('assets//img/products/card-accounting-logo.png') }}"
                                alt="Marketing and sales" width="84" class="rounded">
                            <div class="d-flex flex-column w-100 ms-4">
                                <h6 class="mb-3">Accounting</h6>
                                <div class="row d-flex flex-wrap justify-content-between">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">18</small>
                                                <small class="mb-0 text-truncate">Billing</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">30</small>
                                                <small class="mb-0 text-truncate">Leads</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">28</small>
                                                <small class="mb-0 text-truncate">Sales</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">80</small>
                                                <small class="mb-0 text-truncate">Impression</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-1">
                            <button type="button" class="btn btn-sm btn-outline-primary me-3">Details</button>
                            <button type="button" class="btn btn-sm btn-primary">Report</button>
                        </div>
                    </div>
                    <div class="swiper-slide pb-3">
                        <h5 class="mb-2">Marketing & Sales</h5>
                        <div class="d-flex align-items-center gap-2">
                            <small>Total 245.8k Sales</small>
                            <div class="d-flex text-success">
                                <small class="fw-medium">+25%</small>
                                <i class="mdi mdi-chevron-up"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <img src="{{ asset('assets//img/products/card-sales-overview-logo.png') }}"
                                alt="Marketing and sales" width="84" class="rounded">
                            <div class="d-flex flex-column w-100 ms-4">
                                <h6 class="mb-3">Sales Overview</h6>
                                <div class="row d-flex flex-wrap justify-content-between">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">68</small>
                                                <small class="mb-0 text-truncate">Open</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">04</small>
                                                <small class="mb-0 text-truncate">Lost</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-2 pb-1 align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">52</small>
                                                <small class="mb-0 text-truncate">Converted</small>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <small class="mb-0 me-2 sales-text-bg bg-label-secondary">12</small>
                                                <small class="mb-0 text-truncate">Quotations</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-1">
                            <button type="button" class="btn btn-sm btn-outline-primary me-3">Details</button>
                            <button type="button" class="btn btn-sm btn-primary">Report</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--/ Marketing & Sales-->

        <!-- Live Visitors-->
        <div class="col-lg-4 col-sm-6 order-sm-2 order-lg-0">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between mb-1">
                        <h4 class="mb-0">Live Visitors</h4>
                        <div class="d-flex text-success">
                            <p class="mb-0 me-2">+78.2%</p>
                            <i class="mdi mdi-chevron-up"></i>
                        </div>
                    </div>
                    <small class="text-muted">Total 890 Visitors Are Live</small>
                </div>
                <div class="card-body">
                    <div id="liveVisitors"></div>
                </div>
            </div>
        </div>
        <!--/ Live Visitors--> --}}
    </div>
    {{-- <div class="row gy-4">

        <!-- Roles Datatables -->
        <div class="col-lg-8 col-12">
            <div class="card ">
                <div class="table-responsive rounded-3">
                    <table class="datatables-ecommerce table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3"></th>
                                <th class="py-3">User</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Role</th>
                                <th class="py-3">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Roles Datatables -->

        <!-- visits By Day Chart-->
        <div class="col-12 col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Visits by Day</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="visitsByDayDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitsByDayDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">Total 248.5k Visits</p>
                </div>
                <div class="card-body">
                    <div id="visitsByDayChart"></div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <h6 class="mb-1 fw-semibold">Most Visited Day</h6>
                            <p class="mb-0 text-muted">Total 62.4k Visits on Thursday</p>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="mdi mdi-chevron-right mdi-24px scaleX-n1-rtl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ visits By Day Chart-->
    </div> --}}
@endsection
