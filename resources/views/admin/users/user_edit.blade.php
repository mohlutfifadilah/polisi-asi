@extends('admin/template/master')

@section('title', 'Data Pengguna')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('content')

    {{-- <div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="avatar">
            <div class="avatar-initial bg-label-primary rounded">
              <div class="mdi mdi-account-outline mdi-24px"></div>
            </div>
          </div>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h5 class="mb-0">8,458</h5>
              <div class="mdi mdi-chevron-down text-danger mdi-24px"></div>
              <small class="text-danger">8.1%</small>
            </div>
            <small class="text-muted">New Customers</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="avatar">
            <div class="avatar-initial bg-label-warning rounded">
              <div class="mdi mdi-poll mdi-24px"></div>
            </div>
          </div>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h5 class="mb-0">$28.5K</h5>
              <div class="mdi mdi-chevron-up text-success mdi-24px"></div>
              <small class="text-success">18.2%</small>
            </div>
            <small class="text-muted">Total Profit</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="avatar">
            <div class="avatar-initial bg-label-info rounded">
              <div class="mdi mdi-trending-up mdi-24px"></div>
            </div>
          </div>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h5 class="mb-0">2,450K</h5>
              <div class="mdi mdi-chevron-down text-danger mdi-24px"></div>
              <small class="text-danger">24.6%</small>
            </div>
            <small class="text-muted">New Transaction</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="avatar">
            <div class="avatar-initial bg-label-success rounded">
              <div class="mdi mdi-currency-usd mdi-24px"></div>
            </div>
          </div>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h5 class="mb-0">$48.2K</h5>
              <div class="mdi mdi-chevron-down text-success mdi-24px"></div>
              <small class="text-success">22.5%</small>
            </div>
            <small class="text-muted">Total Revenue</small>
          </div>
        </div>
      </div>
    </div>
  </div>

</div> --}}

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header p-4">
            <h5 class="card-title">Edit Data Pengguna</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                      @php
                        $id_role = \App\Models\Role::find($user->id_role);
                      @endphp
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="role" class="select2 form-select" name="role">
                                <option value="{{ $id_role->id }}" selected disabled>{{ $id_role->name }}</option>
                                @foreach ($role as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            <label for="country">Role</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="name" placeholder="Isi Nama" name="name"
                                aria-label="Isi Nama" value="{{ $user->name }}"/>
                            <label for="name">Nama Lengkap</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="email" class="form-control" placeholder="Isi Email"
                                aria-label="Isi Email" name="email" value="{{ $user->email }}"/>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="job_or_position" class="form-control phone-mask"
                                placeholder="Jabatan/Pekerjaan" aria-label="" name="job_or_position" value="{{ $user->job_or_position }}"/>
                            <label for="job_or_position">Jabatan/Pekerjaan</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="age" class="form-control" placeholder="Umur" aria-label="jdoe1"
                                name="age" value="{{ $user->age }}"/>
                            <label for="age">Umur</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-150" id="address" placeholder="Desa, Kecamatan" name="address">{{ $user->address }}</textarea>
                            <label for="address">Alamat</label>
                        </div>
                        <button type="submit" class="btn btn-warning me-sm-3 me-1 data-submit">Edit</button>
                        <a href="{{ route('users.index') }}" class="btn btn-label-secondary">Batal</a>
                        {{-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
