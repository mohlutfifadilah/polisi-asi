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
                <div class="card-header p-4 pb-0">
                    <h5 class="card-title">Edit Profile</h5>
                    <hr>
                </div>
                <div class="card-body p-4 pt-1">
                    <form action="{{ url('profile/update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="name" placeholder="Isi Nama"
                                        name="name" aria-label="Isi Nama" value="{{ $user->name }}" />
                                    <label for="name">Nama Lengkap</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="email" class="form-control" placeholder="Isi Email"
                                        aria-label="Isi Email" name="email" value="{{ $user->email }}" />
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="job_or_position" class="form-control phone-mask"
                                        placeholder="Jabatan/Pekerjaan" aria-label="" name="job_or_position"
                                        value="{{ $user->job_or_position }}" />
                                    <label for="job_or_position">Jabatan/Pekerjaan</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="no_wa" class="form-control phone-mask"
                                        placeholder="No Handphone" aria-label="" name="no_wa"
                                        value="{{ $user->no_wa }}" />
                                    <label for="no_wa">No Handphone</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="age" class="form-control" placeholder="Umur"
                                        aria-label="jdoe1" name="age" value="{{ $user->age }}" />
                                    <label for="age">Umur</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control h-px-150" id="address" placeholder="Desa, Kecamatan" name="address">{{ $user->address }}</textarea>
                                    <label for="address">Alamat</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                  <input class="form-control" type="file" id="profile_photo_path" name="profile_photo_path">
                                    <label for="formFile" class="form-label">
                                        Foto Profile
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-warning me-sm-3 me-1 data-submit">Edit</button>
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
