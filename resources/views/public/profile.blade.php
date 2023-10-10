@extends('public/template/master')

@section('title', 'Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection

@section('content')
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                {{-- <div class="user-profile-header-banner">
        <img src="{{asset('assets/img/pages/profile-banner.png')}}" alt="Banner image" class="rounded-top">
      </div> --}}
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4 mt-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('/storage/profile/' . $user->profile_photo_path) }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                        @else
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                        @endif
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    @if ($user->age)
                                        <li class="list-inline-item">
                                            <i class='mdi mdi-account-child me-1 mdi-20px'></i><span
                                                class="fw-semibold">{{ $user->age }} Tahun</span>
                                        </li>
                                    @endif
                                    @if ($user->job_or_position)
                                        <li class="list-inline-item">
                                            <i class='mdi mdi-briefcase-account me-1 mdi-20px'></i><span
                                                class="fw-semibold">{{ $user->job_or_position }}</span>
                                        </li>
                                    @endif
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
            <div class="card">
                <div class="card-body">
                    <small class="card-text text-uppercase text-muted">Tentang</small>
                    <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-account-outline mdi-24px"></i><span
                                class="fw-semibold mx-2">Nama:</span> <span>{{ $user->name }}</span></li>
                        @if ($user->address)
                            <li class="d-flex align-items-center mb-3"><i class="mdi mdi-map-marker mdi-24px"></i><span
                                    class="fw-semibold mx-2">Alamat:</span> <span>{{ $user->address }}</span></li>
                        @endif
                        <li class="d-flex align-items-center mb-3"><i class="mdi mdi-calendar mdi-24px"></i><span
                                class="fw-semibold mx-2">Bergabung pada:</span>
                            <span>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                        </li>
                        {{-- <li class="d-flex align-items-center mb-3"><i class="mdi mdi-translate mdi-24px"></i><span class="fw-semibold mx-2">Languages:</span> <span>English</span></li> --}}
                    </ul>
                    <small class="card-text text-uppercase text-muted">Kontak</small>
                    <ul class="list-unstyled my-2 py-1">
                        <li class="d-flex align-items-center"><i class="mdi mdi-email-outline mdi-24px"></i><span
                                class="fw-semibold mx-2">Email:</span> <span>{{ $user->email }}</span></li>
                        <li class="d-flex align-items-center"><i class="mdi mdi-phone mdi-24px"></i><span
                                class="fw-semibold mx-2">No Telepon:</span> <span>{{ $user->no_wa }}</span></li>
                    </ul>
                    <hr>
                    <a href="{{ url('/profile/edit') }}" class="btn btn-warning btn-md mt-1">Edit Profile</a>
                    <a href="{{ url('/profile/changePassword') }}" class="btn btn-warning btn-md mt-1 float-end">Ganti Password</a>
                </div>
            </div>
            <!--/ About User -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class='mdi mdi-format-list-bulleted mdi-24px me-2'></i>Pengaduan
                        Anda :</h5>
                </div>
                <div class="card-body pt-3 pb-0">
                    <ul class="timeline mb-0">
                        @if ($aduan)
                            @foreach ($aduan as $a)
                                <li class="timeline-item timeline-item-transparent border-0">
                                    <span class="timeline-point timeline-point-danger"></span>
                                    @php
                                        $subkategori = \App\Models\Subkategori::find($a->id_subkategori);
                                    @endphp
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-2 fw-semibold">{{ $subkategori->name }}</h6>
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($a->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</small>
                                        </div>
                                        <p class="text-justify mb-1 mt-2">{{ $a->aduan }}</p>
                                        <p class="text-muted mb-2">{{ $a->response }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p class="text-muted text-center">Anda belum pernah mengajukan aduan</p>
                        @endif
                    </ul>
                </div>
            </div>
            <!--/ Activity Timeline -->
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection
