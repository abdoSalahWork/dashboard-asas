@extends('layouts.app2')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
    @php
        Session::forget('error');
    @endphp
</div>
@endif
<div class="d-flex flex-column flex-root text-right" dir="rtl">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="../../demo1/dist/index.html" class="mb-12">
                <img alt="Logo" src="{{asset('/assets/image/app/logo.png')}}" class="" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" action="{{URL('facility_owner')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-10 text-center">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">انشاء حساب جديد</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4"> لديك حساب؟
                        <a href="{{URL('/login_page/facility')}}" class="link-primary fw-bolder">سجل دخول من هنا</a></div>
                        <!--end::Link-->
                    </div>
                    <div class="row fv-row mb-7">
                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">الاسم</label>
                            <input class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" type="text" placeholder="" name="name" autocomplete="off" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <label class="form-label fw-bolder text-dark fs-6">اسم المؤسسة </label>
                            <input class="form-control form-control-lg form-control-solid  @error('name_corporation') is-invalid @enderror" type="text" placeholder="" name="name_corporation" autocomplete="off" />
                            @error('name_corporation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-xl-3">
                            <label class="form-label fw-bolder text-dark fs-6">اسم المؤسسه عربي  </label>
                            <input class="form-control form-control-lg form-control-solid  @error('name_corporation_ar') is-invalid @enderror" type="text" placeholder="" name="name_corporation_ar" autocomplete="off" />
                            @error('name_corporation_ar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">رقم الهاتف </label>
                        <input class="form-control form-control-lg form-control-solid  @error('phone') is-invalid @enderror" type="phone" placeholder="" name="phone" autocomplete="off" />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row fv-row mb-7">
                        <!--begin::Label-->
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">خط العرض</label>
                            <input class="form-control form-control-lg form-control-solid  @error('latitude') is-invalid @enderror" id="latitude" type="text" placeholder="" name="latitude" autocomplete="off" />
                            @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">خط الطول </label>
                            <input class="form-control form-control-lg form-control-solid  @error('longitude') is-invalid @enderror" id="longitude" type="text" placeholder="" name="longitude" autocomplete="off" />
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6">كلمة المرور</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror" type="password" placeholder="" name="password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">..استخدم 8 أحرف أو أكثر مع مزيج من الأحرف والأرقام والرموز</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group-->
                    {{-- <div class="fv-row mb-5">
                        <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off" />
                    </div> --}}
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    {{-- <div class="fv-row mb-10">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" />
                            <span class="form-check-label fw-bold text-gray-700 fs-6">I Agree
                            <a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span>
                        </label>
                    </div> --}}
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                            <span class="indicator-label">تسجيل</span>
                            <span class="indicator-progress">منفضلك انتظر قليلا...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        {{-- <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
            <!--end::Links-->
        </div> --}}
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>
@endsection
<script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
      

      $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
    }

    getLocation();
    </script>