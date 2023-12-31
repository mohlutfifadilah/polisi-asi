@extends('admin/template/master')

@section('title', 'Data Aduan')

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
            <h5 class="card-title">Respon Aduan</h5>
        </div>
        <div class="card-body p-4">
            <dl class="row">
                <dt class="col-sm-6">
                    <h5>Data Pengadu :</h5>
                </dt>
                <dd class="col-sm-6 mb-5"></dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">No Handphone</dt>
                <dd class="col-sm-9">{{ $user->no_wa }}</dd>

                <dt class="col-sm-3">Pekerjaan</dt>
                <dd class="col-sm-9">{{ $user->job_or_position }}</dd>

                <dt class="col-sm-3">Umur</dt>
                <dd class="col-sm-9">{{ $user->age }}</dd>

                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $user->address }}</dd>

                @if ($selectedAduan->bukti)
                    <dt class="col-sm-3">Bukti Aduan</dt>
                    <dd class="col-sm-9">
                        <img src="{{ asset('/storage/aduan/' . $selectedAduan->bukti) }}" class="img-fluid d-block"
                            alt="" width="250" height="250">
                    </dd>
                @endif
            </dl>
            <h5 class="mb-4">Aduan :</h5>
            @foreach ($aduan as $aduan)
                <ul class="timeline card-timeline mb-4">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-2 fw-semibold">{{ $aduan->aduan }}</h6>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($aduan->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}</small>
                            </div>
                            <p class="text-muted mb-2">
                                @if (!is_null($aduan->response))
                                    {{ $aduan->response }}
                                @else
                                    <span class="badge rounded-pill bg-danger">Belum direspon</span>
                                @endif
                            </p>
                        </div>
                    </li>
                </ul>
            @endforeach
            <form action="{{ route('aduan.update', $aduan->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-150" id="exampleFormControlTextarea1" placeholder="Ajukan pengaduan disini .."
                                name="aduan" disabled>{{ $aduan->aduan }}</textarea>
                            <label for="exampleFormControlTextarea1">Aduan</label>
                        </div> --}}
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-150" id="response" placeholder="Berikan respon disini .." name="response"></textarea>
                            <label for="response">Respon</label>
                        </div>
                        {{-- <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="age" class="form-control" placeholder="Umur" aria-label="jdoe1"
                                name="age" value="{{ $user->age }}" />
                            <label for="age">Umur</label>
                        </div> --}}
                        <button type="submit" class="btn btn-success me-sm-3 me-1 data-submit">Selesai</button>
                        <a href="{{ route('aduan.index') }}" class="btn btn-label-secondary">Batal</a>
                        {{-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
