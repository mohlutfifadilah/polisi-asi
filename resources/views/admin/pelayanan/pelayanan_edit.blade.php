@extends('admin/template/master')

@section('title', 'Data Pelayanan')

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
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header p-4">
            <h5 class="card-title">Edit Data Pelayanan</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('pelayanan.update', $pelayanan->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating form-floating-outline mb-4">
                                    <input class="form-control" type="file" id="image" name="image">
                                    <label for="image">Upload Image</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" id="url" class="form-control"
                                        placeholder="Url Instagram" aria-label="jdoe1" name="url" value="{{ $pelayanan->url }}"/>
                                    <label for="url">Url Instagram</label>
                                </div>
                        <button type="submit" class="btn btn-warning me-sm-3 me-1 data-submit">Edit</button>
                        <a href="{{ route('pelayanan.index') }}" class="btn btn-label-secondary">Batal</a>
                        {{-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
