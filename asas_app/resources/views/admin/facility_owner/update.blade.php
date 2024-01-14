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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class=" mr-1">بيانات صاحب المؤسسة  </span>
                        @if ($facility_owner->is_deleted == 0)
                        <span class="badge badge-success mr-1">مفعل</span>
                        @else
                            <span class="badge badge-danger mr-1">غير مفعل</span>
                        @endif
                    </div>
                    <div class="card-toolbar">
                        
                        @if ($facility_owner->is_deleted == 1)
                            <a class="btn btn-sm btn-success mr-1" data-toggle="modal" data-target="#exampleModalScrollableDelete">تفعيل</a>
                        @else   
                            <a class="btn btn-sm btn-danger mr-1" data-toggle="modal" data-target="#exampleModalScrollableDelete">تعطيل</a>
                        @endif
                        
                            <a href="{{URL('/admin/facilityAdmin/program')}}/{{$facility_owner->id}}" class="btn btn-sm btn-light-primary font-weight-bold mr-1">اضافة برنامج</a>
                            
                            <a href="{{ URL('admin/facilityAdmin') }}" class="btn btn-sm btn-primary mr-1">
                                رجوع
                            </a>
                    </div>
                </div>
                
                
                <form action="{{URL('/facility_owner', $facility_owner->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">  اسم صاحب الشركة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{$facility_owner->name}}" required placeholder=" ادخل اسم صاحب الشركة" name="name">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> اسم الشركة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid @error('name_corporation') is-invalid @enderror"  value="{{$facility_owner->name_corporation}}" required placeholder=" ادخل اسم الشركة" name="name_corporation">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('name_corporation'))
                                        <span class="text-danger">{{ $errors->first('name_corporation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> اسم الشركة عربي </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid @error('name_corporation_ar') is-invalid @enderror"  value="{{$facility_owner->name_corporation_ar}}" required placeholder=" ادخل اسم الشركة" name="name_corporation_ar">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('name_corporation_ar'))
                                        <span class="text-danger">{{ $errors->first('name_corporation_ar') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> رقم الهاتف  </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid @error('phone') is-invalid @enderror"  value="{{$facility_owner->phone}}" required placeholder=" ادخل الهاتف" name="phone">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        بيانات المؤسسة
                    </h4>
                </div>
                
                <form action="{{URL('/company_data/update', $company_data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span >  صورة المؤسسه </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <img src="{{asset('assets/image/company')}}/{{$company_data->logo}}" alt="image" width="50%"/>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span >  معرف المؤسسه </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <span  class="badge badge-success mr-1">{{$company_data->id}}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> وصف المؤسسة بالعربي </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <textarea type="text" class="form-control form-control-solid @error('desception_ar') is-invalid @enderror" required placeholder=" ادخل  وصف المؤسسة" name="desception_ar">{{$company_data->desception_ar}} </textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('desception_ar'))
                                        <span class="text-danger">{{ $errors->first('desception_ar') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> وصف المؤسسة بالانجليزي </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <textarea type="text" class="form-control form-control-solid @error('desception_en') is-invalid @enderror" required placeholder=" ادخل  وصف المؤسسة" name="desception_en">{{$company_data->desception_en}} </textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('desception_en'))
                                        <span class="text-danger">{{ $errors->first('desception_en') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">  الدولة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select name="id_country" id="" class="js-example-disabled-results form-control form-control-solid">
                                        @foreach ($country as $item)
                                            <option value="{{$item->id}}" @if($company_data->id_country == $item->id) selected @endif>{{$item->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('id_country'))
                                        <span class="text-danger">{{ $errors->first('id_country') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">  المدينة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select name="id_city" id="" class="js-example-disabled-results form-control form-control-solid">
                                        @foreach ($city as $item)
                                            <option value="{{$item->id}}" @if($company_data->id_city == $item->id) selected @endif>{{$item->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('id_city'))
                                        <span class="text-danger">{{ $errors->first('id_city') }}</span>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> عملة المؤسسة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select name="id_coins" id="" class="js-example-disabled-results form-control form-control-solid">
                                        @foreach ($setting_coins as $item)
                                            <option value="{{$item->id}}" @if($company_data->id_coins == $item->id) selected @endif>{{$item->coins_name_ar}}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('id_coins'))
                                        <span class="text-danger">{{ $errors->first('id_coins') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> نوع المؤسسة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select name="id_company_type" id="" class="js-example-disabled-results form-control form-control-solid">
                                        @foreach ($company_type as $item)
                                            <option value="{{$item->id}}" @if($company_data->id_company_type == $item->id) selected @endif>{{$item->type_name_ar}}</option>
                                        @endforeach
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('id_company_type'))
                                        <span class="text-danger">{{ $errors->first('id_company_type') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row fv-row mb-7">
                                <!--begin::Label-->
                                <div class="col-xl-5">
                                    <label class="form-label fw-bolder text-dark fs-6">خط العرض</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('latitude') is-invalid @enderror" value="{{$company_data->latitude}}" id="latitude" type="text" placeholder="" name="latitude" autocomplete="off" />
                                    @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
            
                                <div class="col-xl-5">
                                    <label class="form-label fw-bolder text-dark fs-6">خط الطول </label>
                                    <input class="form-control form-control-lg form-control-solid  @error('longitude') is-invalid @enderror" value="{{$company_data->longitude}}" id="longitude" type="text" placeholder="" name="longitude" autocomplete="off" />
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

                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="">  صور </span>
                                    
                                </label>
                                <!--end::Label-->
                                <input type="file" class="form-control form-control-solid " value="" placeholder="image" name="logo">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <hr>
                            <div class="row fv-row mb-7">
                                <!--begin::Label-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">عنوان موقع الانترنت الرسمي للمؤسسة</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('URL_WEBSITE') is-invalid @enderror" value="{{$company_data->URL_WEBSITE}}" id="URL_WEBSITE" type="text" placeholder="" name="URL_WEBSITE" autocomplete="off" />
                                    @error('URL_WEBSITE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
            
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">عنوان صقحة الفيس بوك</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('FACEBOOK') is-invalid @enderror" value="{{$company_data->FACEBOOK}}" id="FACEBOOK" type="text" placeholder="" name="FACEBOOK" autocomplete="off" />
                                    @error('FACEBOOK')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row fv-row mb-7">
                                <!--begin::Label-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">عنوان صفحة انستثرام</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('INSTEGRAM') is-invalid @enderror" value="{{$company_data->INSTEGRAM}}" id="INSTEGRAM" type="text" placeholder="" name="INSTEGRAM" autocomplete="off" />
                                    @error('INSTEGRAM')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
            
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">عنوان صفحات اخرى</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('OTHER_TITLE') is-invalid @enderror" value="{{$company_data->OTHER_TITLE}}" id="OTHER_TITLE" type="text" placeholder="" name="OTHER_TITLE" autocomplete="off" />
                                    @error('OTHER_TITLE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row fv-row mb-7">
                                <!--begin::Label-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">ملاحظة 1</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('NOTES_1') is-invalid @enderror" value="{{$company_data->NOTES_1}}" id="NOTES_1" type="text" placeholder="" name="NOTES_1" autocomplete="off" />
                                    @error('NOTES_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
            
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">ملاحظة 2</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('NOTES_2') is-invalid @enderror" value="{{$company_data->NOTES_2}}" id="NOTES_2" type="text" placeholder="" name="NOTES_2" autocomplete="off" />
                                    @error('NOTES_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">ملاحظة 3</label>
                                    <input class="form-control form-control-lg form-control-solid  @error('NOTES_3') is-invalid @enderror" value="{{$company_data->NOTES_3}}" id="NOTES_3" type="text" placeholder="" name="NOTES_3" autocomplete="off" />
                                    @error('NOTES_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

            {{-- media --}}
            <div class="card card-custom gutter-b" id="mdedia">
                <div class="card-header">
                    <div class="card-title">
                    <h3 class="card-label">
                    الصور
                    <small> </small>
                    </h3>
                    </div>
                    <div class="card-toolbar">
                    <a href="#more_sevice" class="btn btn-sm btn-light-primary font-weight-bold" data-toggle="modal" data-target="#exampleModalScrollableAddMedia">
                        <i class="flaticon2-cube" ></i> اضف جديد
                    </a>
                </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th></th>
    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1;?>
                            @foreach ($media as $item)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>
                                        <img src="{{asset('assets/image/company/'.$item->media)}}" alt="" style="width: 100px;height: 100px;"  class="img-thumbnail">
                                    </td>
    
                                    <td>
                                        <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDeleteMedia{{$item->id}}">حذف</a>
                                    </td>
    
                                    
            
                                </tr>
    
    
    
                                <!-- Modal delete-->
                                <div class="modal " id="exampleModalScrollableDeleteMedia{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    هل انت متأكد من العملية                                               
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{URL('/admin/media',$item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    
    
                            @endforeach
                            <!-- Modal Add -->
                            <div class="modal fade" id="exampleModalScrollableAddMedia" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{URL('/admin/media')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body" style="height: 300px;">
                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required"> الصور</span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="file" class="form-control form-control-solid @error('media') is-invalid @enderror"  value="" placeholder=" ادخل الصورة" name="media[]" required multiple>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('media'))
                                                        <span class="text-danger">{{ $errors->first('media') }}</span>
                                                    @endif
                                                </div>
                                            
    
                                                <input type="hidden" value="{{$facility_owner->id}}" name="id_" >
                                                <input type="hidden" value="company" name="table_name" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold">حفظ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <br>
            <br>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تغير كلمة المرور
                    </h4>
                </div>
                <form action="{{URL('/facility_m/facility_owner/update/password')}}" method="post" name="formPassword" onsubmit="return validateFormPassword()">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">  كلمة المرور القديمة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="password" class="form-control form-control-solid @error('old_password') is-invalid @enderror"  value="" required placeholder=" ادخل كلمة المرور القديمة  " name="old_password">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('old_password'))
                                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"> كلمة المرور الجديدة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror"  required placeholder=" ادخل كلمة المرور الجديدة" name="password">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
 
                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">تأكيد كلمة المرور الجديدة </span>
                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="password" class="form-control form-control-solid @error('conferm_password') is-invalid @enderror"required placeholder=" ادخل كلمة المرور القديمة" name="conferm_password">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    @if ($errors->has('conferm_password'))
                                        <span class="text-danger">{{ $errors->first('conferm_password') }}</span>
                                    @endif
                                </div>
                            </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<br>
<br>
<br>
        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                البرامج
                <small>عرض الجميع</small>
              </h3>
             </div>
             <div class="card-toolbar">
                <a href="{{URL('/admin/facilityAdmin/program')}}/{{$facility_owner->id}}" class="btn btn-sm btn-light-primary font-weight-bold">
                    <i class="flaticon2-cube"></i> اضف جديد
                </a>
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الاسم انجليزي</th>
                            <th>المعرف الخاص بالبرنامج</th>
                            {{-- <th>نوع البرنامج</th> --}}
                            <th>السعر ب{{$my_coins->coins_name_ar}}</th>
                            <th>الترتيب</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($programs as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$item->name_ar}}</td>
                                <td>{{$item->name_en}}</td>
                                <td>{{$item->id}}</td>
                                {{-- <td>{{$item->time_type_ar}}</td> --}}
                                <td>{{$item->price_main * $my_coins->dollar}}</td>
                                <td>{{$item->sort}}</td>
                                <td>
                                    <a href="{{URL('/admin/programs2/edit')}}/{{$item->id}}" type="button" class="btn btn-primary" >
                                        فتح                                       
                                    </a>
                                   
                                </td>
    
                                <td>
                                    <a href="{{URL('/admin/program/copy')}}/{{$item->id}}" type="button" class="btn btn-success" >
                                        نسخ                                       
                                    </a>                                </td>
                                <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDeleteProgram{{$item->id}}">حذف</a>
                                </td>
        
                            </tr>

    
    
                            <!-- Modal delete-->
                            <div class="modal " id="exampleModalScrollableDeleteProgram{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                هل انت متأكد من العملية                                               
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{URL('/admin/programs',$item->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </tbody>
                </table>
                {{-- {{$programs->links('vendor.pagination.bootstrap-4')}} --}}
            </div>
        </div>
    <!-- Modal delete-->
    <div class="modal " id="exampleModalScrollableDelete" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        هل انت متأكد من العملية                                               
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form action="{{URL('/admin/facility_owner',$facility_owner->id)}}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                        @if ($facility_owner->is_deleted == 0)
                            <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                        @else
                            <button type="submit" class="btn btn-success font-weight-bold">تفعيل</button>
                        @endif
                    </div>
                </form>
            </div>
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

    // getLocation();
    </script>


<script>
    function validateFormPassword(){
        let newPassword = document.forms["formPassword"]["password"].value;
        let confermPassword = document.forms["formPassword"]["conferm_password"].value;
        if(newPassword != confermPassword){
            alert("كلمة المرور الجديدة وتأكيد كلمة المرور الجديدة غير متطابقة");
            return false;
        }

    }

    $(document).ready( function () {
        $('.table').DataTable({
            dom: "Blfrtip",
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }] ,
        });
    } );
</script>
@endsection