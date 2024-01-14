@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
صاحب مؤسسة جديد
@endsection
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
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    مؤسسة
                    <small>اضف جديد</small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ URL('admin/facilityAdmin') }}" class="btn btn-sm btn-primary mr-1">
                    رجوع
                </a>
            </div>
            </div>
            <div class="card-body">

            <form action="{{url('/admin/facility_owner')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row fv-row mb-7">
                    <!--begin::Label-->
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">الاسم</label>
                        <input class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" type="text" placeholder="" name="name" autocomplete="off" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-xl-3">
                        <label class="form-label fw-bolder text-dark fs-6">اسم المؤسسة</label>
                        <input class="form-control form-control-lg form-control-solid  @error('name_corporation') is-invalid @enderror" type="text" placeholder="" name="name_corporation" autocomplete="off" />
                        @error('name_corporation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-xl-3">
                        <label class="form-label fw-bolder text-dark fs-6"> اسم المؤسسه عربي</label>
                        <input class="form-control form-control-lg form-control-solid  @error('name_corporation_ar') is-invalid @enderror" type="text" placeholder="" name="name_corporation_ar" autocomplete="off" />
                        @error('name_corporation_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            
                <div class="fv-row mb-7">
                    <label class="form-label fw-bolder text-dark fs-6">رقم الموبايل </label>
                    <input class="form-control form-control-lg form-control-solid  @error('phone') is-invalid @enderror" type="phone" placeholder="" name="phone" autocomplete="off" />
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="fv-row mb-3">
                        <select name="id_coins" id="" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($setting_coins as $item)
                                <option value="{{$item->id}}">{{$item->coins_name_ar}}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('id_coins'))
                            <span class="text-danger">{{ $errors->first('id_coins') }}</span>
                        @endif
                    </div>
    
                    <div class="fv-row mb-3">
                        <label class="form-label fw-bolder text-dark fs-6">الدولة  </label>
                        <select name="country" id="" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($country as $item)
                                <option value="{{$item->id}}">{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="fv-row mb-3">
                        <label class="form-label fw-bolder text-dark fs-6">المدينة  </label>
                        <select name="city" id="" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($city as $item)
                                <option value="{{$item->id}}">{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                


                <div class="row fv-row mb-7">
                    <!--begin::Label-->
                    <div class="col-xl-5">
                        <label class="form-label fw-bolder text-dark fs-6">خط العرض</label>
                        <input class="form-control form-control-lg form-control-solid  @error('latitude') is-invalid @enderror" id="latitude" placeholder="" name="latitude" autocomplete="off" />
                        @error('latitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-xl-5">
                        <label class="form-label fw-bolder text-dark fs-6">خط الطول </label>
                        <input class="form-control form-control-lg form-control-solid  @error('longitude') is-invalid @enderror" id="longitude" placeholder="" name="longitude" autocomplete="off" />
                        @error('longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-xl-1">
                        <label class="form-label fw-bolder text-dark fs-6"> موقعي</label>
                        <button class="form-control form-control-lg form-control-solid" type="button" value="" onclick="getLocation()">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </button>
                        @error('longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

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
                            
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Hidden.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z" fill="#000000" fill-rule="nonzero"/>
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) " x="3.02462111" y="11.4246212" width="19" height="2"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>



                                {{-- <i class="bi bi-eye fs-2 d-none"> --}}
                                    
                                </i>
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
                    {{-- <div class="text-muted"></div> --}}
                    <!--end::Hint-->
                </div>




                <input type="hidden" value="1" name="notLogin">
            
                <button type="submit" class="btn btn-primary">اضف</button>


            </form>

            </div>
        </div>

    </div>

@endsection
@section('scripts')
<script type="text/javascript">
    var x = document.getElementById("demo");
    
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
@endsection