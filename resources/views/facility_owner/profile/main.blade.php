@extends('facility_owner.layout.main')
@section('content')
    <div class="container">
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
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            بيانات صاحب المؤسسة
                        </h4>
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
                                            <span class="required"> اسم الشركة </span>
                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid @error('name_corporation_ar') is-invalid @enderror"  value="{{$facility_owner->name_corporation_ar}}" required placeholder=" ادخل اسم الشركة عربي" name="name_corporation_ar">
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
                    <form action="{{URL('/facility_m/company_data', $company_data->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">

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
                                                <option value="{{$item->id}}">{{$item->type_name_ar}}</option>
                                            @endforeach
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        @if ($errors->has('id_company_type'))
                                            <span class="text-danger">{{ $errors->first('id_company_type') }}</span>
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


    </div>
                                
@endsection
<script>
    function validateFormPassword(){
        let newPassword = document.forms["formPassword"]["password"].value;
        let confermPassword = document.forms["formPassword"]["conferm_password"].value;
        if(newPassword != confermPassword){
            alert("كلمة المرور الجديدة وتأكيد كلمة المرور الجديدة غير متطابقة");
            return false;
        }

    }
</script>
