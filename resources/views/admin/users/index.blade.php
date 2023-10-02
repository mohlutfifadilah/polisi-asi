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

@section('page-script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
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
            <h5 class="card-title">Data Pengguna</h5>
            <div class="d-flex flex-row-reverse">
                <div class="mt-3">
                    <button class="btn btn-success btn-sm text-right" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#tambahuser" aria-controls="tambahuser"><i class="mdi mdi-plus"></i> Tambah</button>
                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="tambahuser"
                        aria-labelledby="tambahuserLabel">
                        <div class="offcanvas-header">
                          <h5 id="tambahuserLabel" class="offcanvas-title">Tambah Pengguna</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <form class="add-new-user pt-0" id="addNewUserForm" action="{{ route('users.store') }}" method="POST">
                              @csrf
                              <div class="form-floating form-floating-outline mb-4">
                                  <select id="role" class="select2 form-select" name="role">
                                      <option value="" selected disabled>Pilih Role</option>
                                      @foreach ($role as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                      @endforeach
                                  </select>
                                  <label for="country">Role</label>
                              </div>
                                <div class="form-floating form-floating-outline mb-4">
                                  <input type="text" class="form-control" id="name" placeholder="Isi Nama"
                                  name="name" aria-label="Isi Nama" />
                                  <label for="name">Nama Lengkap</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="email" class="form-control"
                                        placeholder="Isi Email" aria-label="Isi Email"
                                        name="email" />
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="job_or_position" class="form-control phone-mask"
                                        placeholder="Jabatan/Pekerjaan" aria-label=""
                                        name="job_or_position" />
                                    <label for="job_or_position">Jabatan/Pekerjaan</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="no_wa" class="form-control phone-mask"
                                        placeholder="Jabatan/Pekerjaan" aria-label=""
                                        name="no_wa" />
                                    <label for="no_wa">No Handphone</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="age" class="form-control"
                                        placeholder="Umur" aria-label="jdoe1" name="age" />
                                    <label for="age">Umur</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                  <textarea class="form-control h-px-150" id="address" placeholder="Desa, Kecamatan" name="address"></textarea>
                                  <label for="address">Alamat</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" id="password" class="form-control"
                                        placeholder="Password" aria-label="jdoe1" name="password" />
                                    <label for="password">Password</label>
                                </div>
                                <button type="submit" class="btn btn-success me-sm-3 me-1 data-submit">Tambah</button>
                                <button type="reset" class="btn btn-label-secondary"
                                    data-bs-dismiss="offcanvas">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            {{-- <table class="datatables-users table">
      <thead class="table-light">
        <tr>
          <th></th>
          <th></th>
          <th>User</th>
          <th>Role</th>
          <th>Plan</th>
          <th>Billing</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table> --}}
            {{ $dataTable->table(['class' => 'table table-bordered py-4']) }}
        </div>
    </div>
@endsection
