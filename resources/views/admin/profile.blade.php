@extends('admin/template/master')

@section('title', 'Profile')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
@endsection

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-profile.js')}}"></script>
@endsection

@section('content')
@php
          function waktuLalu($timestamp) {
          $selisih = time() - $timestamp;
          if ($selisih < 60) {
              return $selisih . " detik yang lalu";
          } elseif ($selisih < 3600) {
              return round($selisih / 60) . " menit yang lalu";
          } elseif ($selisih < 86400) {
              return round($selisih / 3600) . " jam yang lalu";
          } elseif ($selisih < 2592000) { // kurang dari 30 hari (sekitar 1 bulan)
              return round($selisih / 86400) . " hari yang lalu";
          } elseif ($selisih < 31536000) { // kurang dari 365 hari (sekitar 1 tahun)
              return round($selisih / 2592000) . " bulan yang lalu";
          } else {
              return round($selisih / 31536000) . " tahun yang lalu";
          }
      }
        @endphp
<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      {{-- <div class="user-profile-header-banner">
        <img src="{{asset('assets/img/pages/profile-banner.png')}}" alt="Banner image" class="rounded-top">
      </div> --}}
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4 mt-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{ $user->name }}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item">
                  <i class='mdi mdi-account-child me-1 mdi-20px'></i><span class="fw-semibold">{{ $user->age }} Tahun</span>
                </li>
                <li class="list-inline-item">
                  <i class='mdi mdi-briefcase-account me-1 mdi-20px'></i><span class="fw-semibold">{{ $user->job_or_position }}</span>
                </li>
                {{-- <li class="list-inline-item">
                  <i class='mdi mdi-calendar-range me-1 mdi-20px'></i><span class="fw-semibold">{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span></li> --}}
              </ul>
            </div>
            {{-- <a href="javascript:void(0)" class="btn btn-primary">
              <i class='mdi mdi-account-check-outline me-1'></i>Connected
            </a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<!-- Navbar pills -->
{{-- <div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class='mdi mdi-account-outline me-1 mdi-20px'></i>Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-teams')}}"><i class='mdi mdi-account-multiple-outline me-1 mdi-20px'></i>Teams</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-projects')}}"><i class='mdi mdi-view-grid-outline me-1 mdi-20px'></i>Projects</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-connections')}}"><i class='mdi mdi-link me-1 mdi-20px'></i>Connections</a></li>
    </ul>
  </div>
</div> --}}
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
  <div class="col-xl-4 col-lg-5 col-md-5">
    <!-- About User -->
    <div class="card mb-4">
      <div class="card-body">
        <small class="card-text text-uppercase text-muted">Tentang</small>
        <ul class="list-unstyled my-3 py-1">
          <li class="d-flex align-items-center mb-3"><i class="mdi mdi-account-outline mdi-24px"></i><span class="fw-semibold mx-2">Nama:</span> <span>{{ $user->name }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="mdi mdi-map-marker mdi-24px"></i><span class="fw-semibold mx-2">Alamat:</span> <span>{{ $user->address }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="mdi mdi-calendar mdi-24px"></i><span class="fw-semibold mx-2">Bergabung pada:</span> <span>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span></li>
          {{-- <li class="d-flex align-items-center mb-3"><i class="mdi mdi-translate mdi-24px"></i><span class="fw-semibold mx-2">Languages:</span> <span>English</span></li> --}}
        </ul>
        <small class="card-text text-uppercase text-muted">Kontak</small>
        <ul class="list-unstyled my-2 py-1">
          {{-- <li class="d-flex align-items-center mb-3"><i class="mdi mdi-phone-outline mdi-24px"></i><span class="fw-semibold mx-2">Contact:</span> <span>(123) 456-7890</span></li>
          <li class="d-flex align-items-center mb-3"><i class="mdi mdi-message-outline mdi-24px"></i><span class="fw-semibold mx-2">Skype:</span> <span>john.doe</span></li> --}}
          <li class="d-flex align-items-center"><i class="mdi mdi-email-outline mdi-24px"></i><span class="fw-semibold mx-2">Email:</span> <span>{{ $user->email }}</span></li>
        </ul>
        {{-- <small class="card-text text-uppercase text-muted">Teams</small>
        <ul class="list-unstyled mb-0 mt-3 pt-1">
          <li class="d-flex align-items-center mb-3"><i class="mdi mdi-github mdi-24px text-secondary me-2"></i>
            <div class="d-flex flex-wrap"><span class="fw-semibold me-2">Backend Developer</span><span>(126 Members)</span></div>
          </li>
          <li class="d-flex align-items-center"><i class="mdi mdi-react mdi-24px text-info me-2"></i>
            <div class="d-flex flex-wrap"><span class="fw-semibold me-2">React Developer</span><span>(98 Members)</span></div>
          </li>
        </ul> --}}
      </div>
    </div>
    <!--/ About User -->
  </div>
  <div class="col-xl-8 col-lg-7 col-md-7">
    <!-- Activity Timeline -->
    <div class="card card-action mb-4">
      <div class="card-header align-items-center">
        <h5 class="card-action-title mb-0"><i class='mdi mdi-format-list-bulleted mdi-24px me-2'></i>Pengaduan Anda :</h5>
        {{-- <div class="card-action-element">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical mdi-24px text-muted"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
            </ul>
          </div>
        </div> --}}
      </div>
      <div class="card-body pt-3 pb-0">
        <ul class="timeline mb-0">
          @foreach ($aduan as $a)
            <li class="timeline-item timeline-item-transparent border-0">
            <span class="timeline-point timeline-point-danger"></span>
            @php
              $subkategori = \App\Models\Subkategori::find($a->id_subkategori);
            @endphp
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">{{ $subkategori->name }}</h6>
                <span class="text-muted">{{ waktuLalu(strtotime($a->created_at)) }}</span>
              </div>
              <p class="text-muted mb-0">{{ $a->aduan }}</p>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <!--/ Activity Timeline -->
  </div>
</div>
<!--/ User Profile Content -->
@endsection
