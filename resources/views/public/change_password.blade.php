@extends('public/template/master')

@section('title', 'Ganti Password')

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
                <div class="card-header p-4 pb-0">
                    <h5 class="card-title">Ganti Password</h5>
                    <hr>
                </div>
                <div class="card-body p-4 pt-1">
                    <form action="{{ url('profile/updatePassword', $user->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" id="password_lama" class="form-control" placeholder="Password Lama"
                                        aria-label="Password Lama" name="password_lama" value="" />
                                    <label for="password_lama">Password Lama</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" id="password" class="form-control" placeholder="Password Baru"
                                        aria-label="Password Baru" name="password" value="" />
                                    <label for="password">Password Baru</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru"
                                        aria-label="Konfirmasi Password Baru" name="password_confirmation" value="" />
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                </div>
                                <button type="submit" class="btn btn-warning me-sm-3 me-1 data-submit">Ganti</button>
                                <a href="{{ url('/profile') }}" class="btn btn-label-secondary">Batal</a>
                                {{-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button> --}}
                            </div>
                        </div>
                    </form>
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
@endsection
