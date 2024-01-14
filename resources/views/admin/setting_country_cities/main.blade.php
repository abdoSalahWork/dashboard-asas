@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'المدن و الدول')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif
<div class="container">
    <div class="row">

{{--        Countries--}}
        <div class="col-lg-6 col-sm-12">
{{--            Add countries--}}
            <div class="card card-custom gutter-b">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                        الدول
                    <small>اضف جديد</small>
                  </h3>
                 </div>
                </div>
                <div class="card-body">

                 <form action="{{url('/admin/setting/CountryCity')}}" method="post">
                    @csrf
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  الدولة انجليزي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}" required placeholder=" ادخل الدولة بالانجليزي" name="name_en">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_en'))
                              <span class="text-danger">{{ $errors->first('name_en') }}</span>
                          @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  الدولة عربي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" placeholder="  ادخل الدولة بالعربي" name="name_ar">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_ar'))
                              <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                          @endif
                    </div>

                    <input type="hidden" name="type" value="country">

                    <button type="submit" class="btn btn-primary">اضف</button>

                 </form>

                </div>
            </div>

            <br>
{{--            Show all countries--}}
            <div class="card card-custom gutter-b">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                    الدول
                    <small>عرض الجميع</small>
                  </h3>
                 </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الدولة انجليزي</th>
                                <th>  الدولة عربي</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1;?>
                            @foreach ($setting_country as $item)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$item->name_en}}</td>
                                    <td>{{$item->name_ar}}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}">
                                            تعديل
                                        </button>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}">حذف</a>
                                    </td>

                                </tr>

                                <!-- Modal update-->
                                <div class="modal fade" id="exampleModalScrollable{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{URL('/admin/setting/CountryCity',$item->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body" style="height: 300px;">
                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required"> الدولة انجليزي</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{$item->name_en}}" placeholder="  ادخل العملة بالانجليزي" name="name_en">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('name_en'))
                                                              <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                                          @endif
                                                    </div>

                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required">الدولة عربي</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{$item->name_ar}}" placeholder="   ادخل العملة بالعربي" name="name_ar">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('name_ar'))
                                                              <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                                          @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold">حفظ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal delete-->
                                <div class="modal " id="exampleModalScrollableDelete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                            <form action="{{URL('/admin/setting/CountryCity',$item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                    @if($item->is_deleted == 1)
                                                        <button type="submit" class="btn btn-primary font-weight-bold">ارجاع</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


{{--        Citites--}}
        <div class="col-lg-6 col-sm-12">
{{--            Add citites--}}
            <div class="card card-custom gutter-b">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                        المدن
                    <small>اضف جديد</small>
                  </h3>
                 </div>
                </div>
                <div class="card-body">

                 <form action="{{url('/admin/setting/CountryCity')}}" method="post">
                    @csrf
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  المدينة انجليزي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}" required placeholder=" ادخل المدينة بالانجليزي" name="name_en">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_en'))
                              <span class="text-danger">{{ $errors->first('name_en') }}</span>
                          @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  المدينة عربي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" placeholder="  ادخل المدينة بالعربي" name="name_ar">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_ar'))
                              <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                          @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">   خطول العرض</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('Latitude') is-invalid @enderror" value="{{ old('Latitude') }}" placeholder=" خطوط العرض" name="Latitude">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('Latitude'))
                              <span class="text-danger">{{ $errors->first('Latitude') }}</span>
                          @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">   خطوط الطول</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('Longitude') is-invalid @enderror" value="{{ old('Longitude') }}" placeholder=" خطوط الطول" name="Longitude">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('Longitude'))
                              <span class="text-danger">{{ $errors->first('Longitude') }}</span>
                          @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">الدولة</label>
                        <div class="col-10">
                            <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                @foreach ($setting_country as $item)
                                    <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="city">
                    <button type="submit" class="btn btn-primary">اضف</button>

                 </form>

                </div>
            </div>

            <br>
{{--                Show all citites--}}
            <div class="card card-custom gutter-b">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                    المدن
                    <small>عرض الجميع</small>
                  </h3>
                 </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المدينة انجليزي</th>
                                <th>  المدينة عربي</th>
                                <th>الدولة</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1;?>
                            @foreach ($setting_city as $item)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$item->name_en}}</td>
                                    <td>{{$item->name_ar}}</td>
                                    <td>{{$item->country_name_ar}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}">
                                            تعديل
                                        </button>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDeleteCity{{$item->id}}">حذف</a>
                                    </td>

                                </tr>

                                <!-- Modal delete-->
                                <div class="modal fade" id="exampleModalScrollableDeleteCity{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                            <form action="{{URL('/admin/setting/CountryCity',$item->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-footer">

                                                        <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal update-->
                                <div class="modal fade" id="exampleModalScrollable{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{URL('/admin/setting/CountryCity',$item->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body" style="height: 300px;">
                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required"> المدينة انجليزي</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{$item->name_en}}" placeholder="  ادخل المدينة بالانجليزي" name="name_en">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('name_en'))
                                                              <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                                          @endif
                                                    </div>

                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required">المدينة عربي</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{$item->name_ar}}" placeholder="   ادخل المدينة بالعربي" name="name_ar">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('name_ar'))
                                                              <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                                          @endif
                                                    </div>
                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required">   خطول العرض</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('Latitude') is-invalid @enderror" value="{{$item->Latitude}}" placeholder=" خطوط العرض" name="Latitude">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('Latitude'))
                                                              <span class="text-danger">{{ $errors->first('Latitude') }}</span>
                                                          @endif
                                                    </div>

                                                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required">   خطوط الطول</span>
                                                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid @error('Longitude') is-invalid @enderror" value="{{$item->Longitude}}" placeholder=" خطوط الطول" name="Longitude">
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                        @if ($errors->has('Longitude'))
                                                              <span class="text-danger">{{ $errors->first('Longitude') }}</span>
                                                          @endif
                                                    </div>

                                                    <?php $myChooseCountry = $item->id_country;?>
                                                    <div class="form-group row">
                                                        <label class="col-2 col-form-label">الدولة</label>
                                                        <div class="col-10">
                                                            <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                                                @foreach ($setting_country as $item)
                                                                    <option value="{{$item->id}}" @if($item->id == $myChooseCountry)selected @endif>{{$item->name_ar}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold">حفظ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    {{--        Areas--}}
    <div class="col-lg-6 col-sm-12">
        {{--            Add areas--}}
        <div class="card card-custom gutter-b" style="
    width: 1125px;
    margin-top: 20px;
    ">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        المناطق
                        <small>اضف جديد</small>
                    </h3>
                </div>
            </div>
            <div class="card-body">

                <form action="{{url('/admin/setting/CountryCity')}}" method="post">
                    @csrf
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  المنطقة انجليزي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}" required placeholder=" ادخل المنطقة بالانجليزي" name="name_en">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_en'))
                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                        @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">  المنطقة عربي</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" placeholder="  ادخل المنطقة بالعربي" name="name_ar">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_ar'))
                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                        @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">   خطول العرض</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('Latitude') is-invalid @enderror" value="{{ old('Latitude') }}" placeholder=" خطوط العرض" name="Latitude">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('Latitude'))
                            <span class="text-danger">{{ $errors->first('Latitude') }}</span>
                        @endif
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">   خطوط الطول</span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('Longitude') is-invalid @enderror" value="{{ old('Longitude') }}" placeholder=" خطوط الطول" name="Longitude">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('Longitude'))
                            <span class="text-danger">{{ $errors->first('Longitude') }}</span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">الدولة</label>
                        <div class="col-10">
                            <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                @foreach ($setting_country as $item)
                                    <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">المدينة</label>
                        <div class="col-10">
                            <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                @foreach ($setting_city as $item)
                                    <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="area">
                    <button type="submit" class="btn btn-primary">اضف</button>

                </form>

            </div>
        </div>

        <br>
        {{--                Show all areas--}}
        <div class="card card-custom gutter-b" style="
    width: 1125px;
    margin-top: 20px;
    " >
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        المناطق
                        <small>عرض الجميع</small>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
{{--                        <th>#</th>--}}
                        <th>المنطقه انجليزي</th>
                        <th>  المنطقه عربي</th>
                        <th>الدولة</th>
                        <th>المدينة</th>
                        <th></th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1;?>
                    @foreach ($setting_area as $item)
                        <tr>
{{--                            <td>{{$counter++}}</td>--}}
                            <td>{{$item->name_en}}</td>
                            <td>{{$item->name_ar}}</td>
                            <td>الرياض</td>
                            <td>السعودية</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}">
                                    تعديل
                                </button>
                            </td>
                            <td>
                                <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDeleteCity{{$item->id}}">حذف</a>
                            </td>

                        </tr>

                        <!-- Modal delete-->
                        <div class="modal fade" id="exampleModalScrollableDeleteCity{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                    <form action="{{URL('/admin/setting/district/delete',$item->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input hidden name="type" value="area">

                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal update-->
                        <div class="modal fade" id="exampleModalScrollable{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <form action="{{URL('/admin/setting/CountryCity',$item->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body" style="height: 300px;">


                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> المنطقة انجليزي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{$item->name_en}}" placeholder="  ادخل المدينة بالانجليزي" name="name_en">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('name_en'))
                                                    <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">المنطقة عربي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror" value="{{$item->name_ar}}" placeholder="   ادخل المدينة بالعربي" name="name_ar">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('name_ar'))
                                                    <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                                @endif
                                            </div>


{{--                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">--}}
{{--                                                    <span class="required">   خطول العرض</span>--}}
{{--                                                    --}}{{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
{{--                                                </label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <input type="text" class="form-control form-control-solid @error('Latitude') is-invalid @enderror" value="{{$item->Latitude}}" placeholder=" خطوط العرض" name="Latitude">--}}
{{--                                                <div class="fv-plugins-message-container invalid-feedback"></div>--}}
{{--                                                @if ($errors->has('Latitude'))--}}
{{--                                                    <span class="text-danger">{{ $errors->first('Latitude') }}</span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">--}}
{{--                                                    <span class="required">   خطوط الطول</span>--}}
{{--                                                    --}}{{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
{{--                                                </label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <input type="text" class="form-control form-control-solid @error('Longitude') is-invalid @enderror" value="{{$item->Longitude}}" placeholder=" خطوط الطول" name="Longitude">--}}
{{--                                                <div class="fv-plugins-message-container invalid-feedback"></div>--}}
{{--                                                @if ($errors->has('Longitude'))--}}
{{--                                                    <span class="text-danger">{{ $errors->first('Longitude') }}</span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

                                            <input hidden name="type" value="area">

{{--                                            <?php $myChooseCountry = $item->id_country;?>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label class="col-2 col-form-label">الدولة</label>--}}
{{--                                                <div class="col-10">--}}
{{--                                                    <select name="id_country" class="js-example-disabled-results form-control form-control-solid">--}}
{{--                                                        @foreach ($setting_country as $item)--}}
{{--                                                            <option value="{{$item->id}}" @if($item->id == $myChooseCountry)selected @endif>{{$item->name_ar}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            --}}

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-primary font-weight-bold">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



</div>

@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();


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
