@extends('admin/template/master')

@section('title', 'Data Role')

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

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header p-4">
            <h5 class="card-title">Data Role</h5>
            <div class="d-flex flex-row-reverse">
                <div class="mt-3">
                    <button class="btn btn-success btn-sm text-right" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#tambahrole" aria-controls="tambahrole"><i class="mdi mdi-plus"></i>
                        Tambah</button>
                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="tambahrole"
                        aria-labelledby="tambahroleLabel">
                        <div class="offcanvas-header">
                            <h5 id="tambahroleLabel" class="offcanvas-title">Tambah Role</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <form class="add-new-user pt-0" id="addNewUserForm" action="{{ route('role.store') }}"
                                method="POST">
                                @csrf
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Role"
                                        name="name" aria-label="Nama Role" />
                                    <label for="name">Nama Role</label>
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
