@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('public/template/master')

@section('title', 'Reset Password')

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
<div class="position-relative">
  <div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="{{url('/')}}" class="auth-cover-brand d-flex align-items-center gap-2">
      {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#666cff'])</span>
      <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span> --}}
      <img src="{{ asset('assets/img/favicon/logo-dinsos.png') }}" alt="logodinsos" width="180">
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">

      <!-- /Left Section -->
      <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
        <img src="{{asset('assets/img/illustrations/auth-reset-password-illustration-'.$configData['style'].'.png') }}" class="auth-cover-illustration w-100" alt="auth-illustration" data-app-light-img="illustrations/auth-reset-password-illustration-light.png" data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png" />
        <img src="{{asset('assets/img/illustrations/auth-cover-reset-password-mask-'.$configData['style'].'.png') }}" class="authentication-image" alt="mask" data-app-light-img="illustrations/auth-cover-reset-password-mask-light.png" data-app-dark-img="illustrations/auth-cover-reset-password-mask-dark.png" />
      </div>
      <!-- /Left Section -->

      <!-- Reset Password -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
        <div class="w-px-400 mx-auto pt-5 pt-lg-0">
          <h4 class="mb-2 fw-semibold">Reset Password 🔒</h4>
          <p class="mb-4">Isikan Password baru anda</p>
          <form id="formAuthentication" class="mb-3" action="{{ route('reset-password') }}" method="POST">
            @csrf
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <label for="password">Password Baru</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="confirm-password" class="form-control" name="confirm-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <label for="confirm-password">Konfirmasi Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100 mb-3">
              Submit
            </button>
            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                Login Kembali
              </a>
            </div>
          </form>
        </div>
      </div>
      <!-- /Reset Password -->
    </div>
  </div>
</div>
@endsection
