@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('public/template/master')

@section('title', 'Register Cover - Pages')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover">
  <!-- Logo -->
  <a href="{{url('/')}}" class="auth-cover-brand d-flex align-items-center gap-2">
    {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#666cff'])</span>
    <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span> --}}
    <img src="{{ asset('assets/img/favicon/logo-dinsos.png') }}" alt="logodinsos" width="180">
  </a>
  <!-- /Logo -->
  <div class="authentication-inner row m-0">

    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
      <img src="{{asset('assets/img/illustrations/auth-register-illustration-'.$configData['style'].'.png') }}" class="auth-cover-illustration w-100" alt="auth-illustration" data-app-light-img="illustrations/auth-register-illustration-light.png" data-app-dark-img="illustrations/auth-register-illustration-dark.png" />
      <img src="{{asset('assets/img/illustrations/auth-cover-register-mask-'.$configData['style'].'.png') }}" class="authentication-image" alt="mask" data-app-light-img="illustrations/auth-cover-register-mask-light.png" data-app-dark-img="illustrations/auth-cover-register-mask-dark.png" />
    </div>
    <!-- /Left Text -->

    <!-- Register -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
      <div class="w-px-400 mx-auto pt-5 pt-lg-0">
        <h4 class="mb-2 fw-semibold">Bergabung bersama kami</h4>
        <p class="mb-4">Ikut serta untuk membangun negeri</p></p>

        <form id="formAuthentication" class="mb-3" action="{{ route('actionRegister') }}" method="POST">
          @csrf
          <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" autofocus>
            <label for="name">Nama</label>
          </div>
          <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email">
            <label for="email">Email</label>
            {{-- <small id="email-error" class="text-danger hidden">Email sudah ada</small> --}}
          </div>
          <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="Masukkan No Handphone">
            <label for="no_wa">No Handphone</label>
            {{-- <small id="email-error" class="text-danger hidden">Email sudah ada</small> --}}
          </div>
          <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <label for="password">Password</label>
              </div>
              <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
              <label class="form-check-label" for="terms-conditions">
                Saya setuju dengan
                <a href="javascript:void(0);">Syarat dan Ketentuan</a>
              </label>
            </div>
          </div>
          <button class="btn btn-primary d-grid w-100">
            Daftar
          </button>
        </form>

        <p class="text-center mt-2">
          <span>Sudah mempunyai akun?</span>
          <a href="{{ route('login') }}">
            <span>Login</span>
          </a>
        </p>

        {{-- <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center gap-2">
          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
            <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
            <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
            <i class="tf-icons mdi mdi-24px mdi-github"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
            <i class="tf-icons mdi mdi-24px mdi-google"></i>
          </a>
        </div> --}}
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
{{-- <script>
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');

    emailInput.addEventListener('input', async () => {
        const emailValue = emailInput.value;
        const response = await fetch(`/check-email?email=${emailValue}`);
        const data = await response.json();

        if (data.emailExists) {
            emailError.classList.remove('hidden');
        } else {
            emailError.classList.add('hidden');
        }
    });
    // Menambahkan event listener pada saat input mendapatkan fokus
    emailInput.addEventListener('focus', () => {
        emailError.classList.add('hidden');
    });
</script> --}}

@endsection
