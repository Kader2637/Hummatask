@extends('layouts.app')



@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

<script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
@endsection


@section('content')

<div class="col-12 mb-4 p-5">
    <small class="text-light fw-medium">Atur Jadwal</small>
    <div class="bs-stepper wizard-numbered mt-2">
      <div class="bs-stepper-header">
        <div style="width: 200px;" class="step" data-target="#senin">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Senin</span>
              <span class="bs-stepper-subtitle">Atur jadwal</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div style="width: 200px;" class="step" data-target="#selasa">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Selasa</span>
              <span class="bs-stepper-subtitle">Atur jadwal</span>
            </span>
          </button>
        </div>
        <div class="line">
            <i class="ti ti-chevron-right"></i>
          </div>
        <div style="width: 200px;" class="step" data-target="#rabu">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Rabu</span>
              <span class="bs-stepper-subtitle">Atur jadwal</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div style="width: 200px;" class="step" data-target="#kamis">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">2</span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Kamis</span>
                <span class="bs-stepper-subtitle">Atur jadwal</span>
              </span>
            </button>
          </div>
        <div class="line">
            <i class="ti ti-chevron-right"></i>
          </div>
        <div style="width: 200px;" class="step" data-target="#jumat">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Jumat</span>
              <span class="bs-stepper-subtitle">Atur jadwal</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form onSubmit="return false">
          <!-- Senin -->
          <div id="senin" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Account Details</h6>
              <small>Enter Your Account Details.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" class="form-control" placeholder="johndoe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2" />
                  <span class="input-group-text cursor-pointer" id="password2"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="confirm-password">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password2" />
                  <span class="input-group-text cursor-pointer" id="confirm-password2"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Senin -->
          <div id="selasa" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Account Details</h6>
              <small>Enter Your Account Details.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" class="form-control" placeholder="johndoe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2" />
                  <span class="input-group-text cursor-pointer" id="password2"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="confirm-password">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password2" />
                  <span class="input-group-text cursor-pointer" id="confirm-password2"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Rabu -->
          <div id="rabu" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Personal Info</h6>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="first-name">First Name</label>
                <input type="text" id="first-name" class="form-control" placeholder="John" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="last-name">Last Name</label>
                <input type="text" id="last-name" class="form-control" placeholder="Doe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="country">Country</label>
                <select class="select2" id="country">
                  <option label=" "></option>
                  <option>UK</option>
                  <option>USA</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Australia</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="language">Language</label>
                <select class="selectpicker w-auto" id="language" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" multiple>
                  <option>English</option>
                  <option>French</option>
                  <option>Spanish</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Kamis -->
          <div id="kamis" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Personal Info</h6>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="first-name">First Name</label>
                <input type="text" id="first-name" class="form-control" placeholder="John" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="last-name">Last Name</label>
                <input type="text" id="last-name" class="form-control" placeholder="Doe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="country">Country</label>
                <select class="select2" id="country">
                  <option label=" "></option>
                  <option>UK</option>
                  <option>USA</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Australia</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="language">Language</label>
                <select class="selectpicker w-auto" id="language" data-style="btn-transparent" data-icon-base="ti" data-tick-icon="ti-check text-white" multiple>
                  <option>English</option>
                  <option>French</option>
                  <option>Spanish</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="ti ti-arrow-right"></i></button>
              </div>
            </div>
          </div>
          <!-- Social Links -->
          <div id="jumat" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Social Links</h6>
              <small>Enter Your Social Links.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="twitter">Twitter</label>
                <input type="text" id="twitter" class="form-control" placeholder="https://twitter.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="facebook">Facebook</label>
                <input type="text" id="facebook" class="form-control" placeholder="https://facebook.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="google">Google+</label>
                <input type="text" id="google" class="form-control" placeholder="https://plus.google.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="linkedin">LinkedIn</label>
                <input type="text" id="linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-success btn-submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('script')

<script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}"></script>
<script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
<script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
<script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>
<!-- END: Page JS-->

@endsection

