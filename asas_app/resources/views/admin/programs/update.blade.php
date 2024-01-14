@extends('admin.layout.main')
@section('title')
    تعديل برنامج
@endsection

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


        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm header header-fixed" >
                <div class="container">
                    <a class="navbar-brand" href="#">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        البرنامج
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#more_sevice">الخدمات اضافية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#discount"> خصومات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#mdedia"> الصور</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
    
            <main class="py-4">
                @yield('content')
            </main>
        </div>

    



        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                البرنامج
                <small> تعديل</small>
              </h3>
             </div>
             <div class="card-toolbar">
                <a href="{{ URL('admin/facilityAdmin/edit') }}/{{$program->id_facility_owner}}" class="btn btn-sm btn-primary mr-1">
                    <i class="fa fa-arrow-left"></i>
                    رجوع
                </a>
            </div>
            </div>
            <div class="card-body">
    
             <form action="{{route('programs2.update', $program->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col col-lg-6 col-md-12 col-sm-12">
                        <h5>English</h5><br>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">  Name </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{$program->name_en}}" required placeholder=" Enter the name" name="name_en">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('name_en'))
                                  <span class="text-danger">{{ $errors->first('name_en') }}</span>
                              @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"> Description </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('description_en') is-invalid @enderror"  value="" required placeholder=" Enter the description" name="description_en">{{$program->description_en}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('description_en'))
                                  <span class="text-danger">{{ $errors->first('description_en') }}</span>
                              @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">  Age condition </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('age_conditions_en') is-invalid @enderror"  value="{{$program->age_conditions_en}}" required placeholder=" Enter the Age conditions" name="age_conditions_en">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('age_conditions_en'))
                                  <span class="text-danger">{{ $errors->first('age_conditions_en') }}</span>
                              @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >Other conditions</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('other_conditions_en') is-invalid @enderror"  value="" placeholder="Enter the Other Conditions" name="other_conditions_en">{{$program->other_conditions_en}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('other_conditions_en'))
                                <span class="text-danger">{{ $errors->first('other_conditions_en') }}</span>
                            @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >sort</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="number" class="form-control form-control-solid @error('sort') is-invalid @enderror"  value="{{$program->sort}}" placeholder="Enter sort " name="sort">{{$program->sort}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('sort'))
                                <span class="text-danger">{{ $errors->first('sort') }}</span>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >Price note</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('price_note_en') is-invalid @enderror"  value="{{$program->price_note_en}}" placeholder="Enter price note" name="price_note_en">{{$program->price_note_en}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('price_note_en'))
                                <span class="text-danger">{{ $errors->first('price_note_en') }}</span>
                            @endif
                        </div>
                        



                    </div>
                    
                    <div class="col col-lg-6 col-md-12 col-sm-12">
                        <h5>عربي</h5><br>
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">  الاسم </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror"  value="{{$program->name_ar}}" required placeholder=" ادخل الاسم" name="name_ar">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('name_ar'))
                                  <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                              @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"> وصف </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('description_ar') is-invalid @enderror"  value="{{$program->description_ar}}" required placeholder=" ادخل الوصف" name="description_ar">{{$program->description_ar}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('description_ar'))
                                <span class="text-danger">{{ $errors->first('description_ar') }}</span>
                            @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"> شروط العمر  </span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('age_conditions_ar') is-invalid @enderror"  value="{{$program->age_conditions_ar}}" required placeholder="ادخل شروط العمر" name="age_conditions_ar">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('age_conditions_ar'))
                                  <span class="text-danger">{{ $errors->first('age_conditions_ar') }}</span>
                              @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >شروط اخرى</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('other_conditions_ar') is-invalid @enderror"  value="{{$program->other_conditions_ar}}" placeholder=" ادخل الشروط الاخرى" name="other_conditions_ar">{{$program->other_conditions_ar}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('other_conditions_ar'))
                                <span class="text-danger">{{ $errors->first('other_conditions_ar') }}</span>
                            @endif
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >ملاحظة السعر</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('price_note_ar') is-invalid @enderror"  value="{{$program->price_note_ar}}" placeholder="ادخل ملاحظة السعر" name="price_note_ar">{{$program->price_note_ar}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('price_note_ar'))
                                <span class="text-danger">{{ $errors->first('price_note_ar') }}</span>
                            @endif
                        </div>


                    </div>
                </div>
               
            
                <div class="form-group row">
                    <label class="col-2 col-form-label">نوع الدوام</label>
                    <div class="col-10">
                        <select name="id_timeType" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($time_type as $item)
                                <option value="{{$item->id}}" @if($program->id_timeType == $item->id) selected @endif>{{$item->time_type_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label" >نوع البرنامج</label>
                    <div class="col-10">
                        <select name="id_typeProgram" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($program_types as $item)
                                <option value="{{$item->id}}" @if($program->id_typeProgram == $item->id) selected @endif>{{$item->program_type_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">  السعر ب{{$coins_companyData->coins_name_ar}}</span>
                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                    </label>
                    <!--end::Label-->
                    <input type="number" class="form-control form-control-solid @error('price_main') is-invalid @enderror"  value="{{$program->price_main * $coins_companyData->dollar}}" required placeholder=" ادخل السعر" name="price_main">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                    @if ($errors->has('price_main'))
                          <span class="text-danger">{{ $errors->first('price_main') }}</span>
                      @endif
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span >مزايا اخرى</span>
                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                    </label>
                    <!--end::Label-->
                    <textarea type="text" class="form-control form-control-solid @error('other_fute') is-invalid @enderror"  value="{{$program->other_fute}}" placeholder=" ادخل المزايا الاخرى" name="other_fute">{{$program->other_fute}}</textarea>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                    @if ($errors->has('other_fute'))
                        <span class="text-danger">{{ $errors->first('other_fute') }}</span>
                    @endif
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span >  رابط فيديو </span>
                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid @error('url_viedo') is-invalid @enderror"  value="{{$program->url_viedo}}"  placeholder=" ادخل الرابط" name="url_viedo">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                    @if ($errors->has('url_viedo'))
                          <span class="text-danger">{{ $errors->first('url_viedo') }}</span>
                      @endif
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">نوع المنهج</label>
                    <div class="col-10">
                        <select name="id_curriculum_type" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($curriculum_types as $item)
                                <option value="{{$item->id}}" @if($program->id_curriculum_type == $item->id) selected @endif>{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">الجنس</label>
                    <div class="col-10">
                        <select name="Gender" class="js-example-disabled-results form-control form-control-solid">
                            <option value="1" @if($program->Gender == "1") selected @endif>ذكر</option>
                            <option value="0" @if($program->Gender == "0") selected @endif>انثى</option>
                        </select>
                    </div>
                </div>


    

    
    
    
            
                <button type="submit" class="btn btn-primary">تعديل</button>
    
             </form>
    
            </div>
        </div>


        <br>
        <br>
        <br>
        <div class="card card-custom gutter-b" id="more_sevice">
            <div class="card-header">
                <div class="card-title">
                <h3 class="card-label">
                الخدمات الاضافية
                <small> </small>
                </h3>
                </div>
                <div class="card-toolbar">
                <a href="#more_sevice" class="btn btn-sm btn-light-primary font-weight-bold" data-toggle="modal" data-target="#exampleModalScrollableAddService">
                    <i class="flaticon2-cube" ></i> اضف جديد
                </a>
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم انجليزي</th>
                            <th>الاسم عربي</th>
                            <th>السعر</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($service_more as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$item->service_en}}</td>
                                <td>{{$item->service_ar}}</td>
                                <td>{{$item->price}}</td>
                                <td>
                                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}">
                                        تعديل                                       
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}">حذف</a>
                                </td>

                                
        
                            </tr>



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
                                        <form action="{{URL('/admin/services_more',$item->id)}}" method="post">
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
                                        <form action="{{URL('/admin/services_more',$item->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body" style="height: 300px;">
                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">الخدمة بالانجليزي</span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid @error('service_en') is-invalid @enderror"  value="{{$item->service_en}}" placeholder=" ادخل الخدمة" name="service_en">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('service_en'))
                                                        <span class="text-danger">{{ $errors->first('service_en') }}</span>
                                                    @endif
                                                </div>
                                            
                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">الخدمة بالعربي</span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid @error('service_ar') is-invalid @enderror" value="{{$item->service_ar}}" placeholder="ادخل الخدمة " name="service_ar">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('service_ar'))
                                                        <span class="text-danger">{{ $errors->first('service_ar') }}</span>
                                                    @endif
                                                </div>

                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">سعر الخدمة </span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="number" class="form-control form-control-solid @error('price') is-invalid @enderror" value="{{$item->price}}" placeholder="ادخل السعر " name="price">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('price'))
                                                        <span class="text-danger">{{ $errors->first('price') }}</span>
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

                        @endforeach
                            <!-- Modal Add -->
                            <div class="modal fade" id="exampleModalScrollableAddService" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <form action="{{URL('/admin/services_more')}}" method="post">
                                        @csrf
                                        <div class="modal-body" style="height: 300px;">
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">الخدمة بالانجليزي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('service_en') is-invalid @enderror"  value="" placeholder=" ادخل الخدمة" name="service_en">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('service_en'))
                                                    <span class="text-danger">{{ $errors->first('service_en') }}</span>
                                                @endif
                                            </div>
                                        
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">الخدمة بالعربي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('service_ar') is-invalid @enderror" value="" placeholder="ادخل الخدمة " name="service_ar">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('service_ar'))
                                                    <span class="text-danger">{{ $errors->first('service_ar') }}</span>
                                                @endif
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">سعر الخدمة </span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="number" class="form-control form-control-solid @error('price') is-invalid @enderror" value="" placeholder="ادخل السعر " name="price">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('price'))
                                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                            <input type="hidden" value="{{$program->id}}" name="id_program" >
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
                                    <img src="{{asset('assets/image/programs/'.$item->media)}}" alt="" style="width: 100px;height: 100px;"  class="img-thumbnail">
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
                                        

                                            <input type="hidden" value="{{$program->id}}" name="id_" >
                                            <input type="hidden" value="programs" name="table_name" >
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
        <div class="card card-custom gutter-b" id="discount">
            <div class="card-header">
                <div class="card-title">
                <h3 class="card-label">
                 خصومات
                <small> </small>
                </h3>
                </div>
                <div class="card-toolbar">
                <a href="#more_sevice" class="btn btn-sm btn-light-primary font-weight-bold" data-toggle="modal" data-target="#exampleModalScrollableAddDiscount">
                    <i class="flaticon2-cube" ></i> اضف جديد
                </a>
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نسبة الخصم</th>
                            <th> بداية الخصم</th>
                            <th>نهاية الخصم</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($discount as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$item->price_rate_discount}}%</td>
                                <td>{{$item->start_discount}}</td>
                                <td>{{$item->end_discount}}</td>
                                <td>
                                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollableUpdateDiscount{{$item->id}}">
                                        تعديل                                       
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDeleteDiscount{{$item->id}}">حذف</a>
                                </td>

                                
        
                            </tr>



                            <!-- Modal delete-->
                            <div class="modal " id="exampleModalScrollableDeleteDiscount{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                        <form action="{{URL('/admin/discount',$item->id)}}" method="post">
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


                            <!-- Modal update-->
                            <div class="modal fade" id="exampleModalScrollableUpdateDiscount{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{URL('/admin/discount',$item->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body" style="height: 300px;">
                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required"> نسبة الخصم</span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="number" class="form-control form-control-solid @error('price_rate_discount') is-invalid @enderror"  value="{{$item->price_rate_discount}}" placeholder=" ادخل نسبة الخصم" name="price_rate_discount">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('price_rate_discount'))
                                                        <span class="text-danger">{{ $errors->first('price_rate_discount') }}</span>
                                                    @endif
                                                </div>
                                            
                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required"> بداية الخصم</span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="date" class="form-control form-control-solid @error('start_discount') is-invalid @enderror" value="{{$item->start_discount}}" placeholder="ادخل بداية الخصم " name="start_discount">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('start_discount'))
                                                        <span class="text-danger">{{ $errors->first('start_discount') }}</span>
                                                    @endif
                                                </div>

                                                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required"> نهاية الخصم </span>
                                                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="date" class="form-control form-control-solid @error('end_discount') is-invalid @enderror" value="{{$item->end_discount}}" placeholder="ادخل نهاية الخصم " name="end_discount">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    @if ($errors->has('end_discount'))
                                                        <span class="text-danger">{{ $errors->first('end_discount') }}</span>
                                                    @endif
                                                </div>
                                                <input type="hidden" value="{{$program->id}}" name="id_program" >

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
                            <!-- Modal Add -->
                        <div class="modal fade" id="exampleModalScrollableAddDiscount" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <form action="{{URL('/admin/discount')}}" method="post">
                                        @csrf
                                        <div class="modal-body" style="height: 300px;">
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> نسبة الخصم</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="number" class="form-control form-control-solid @error('price_rate_discount') is-invalid @enderror"  value="" placeholder=" ادخل نسبة الخصم" name="price_rate_discount">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('price_rate_discount'))
                                                    <span class="text-danger">{{ $errors->first('price_rate_discount') }}</span>
                                                @endif
                                            </div>
                                        
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> بداية الخصم</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid @error('start_discount') is-invalid @enderror" value="" placeholder="ادخل بداية الخصم " name="start_discount">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('start_discount'))
                                                    <span class="text-danger">{{ $errors->first('start_discount') }}</span>
                                                @endif
                                            </div>

                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> نهاية الخصم </span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="date" class="form-control form-control-solid @error('end_discount') is-invalid @enderror" value="" placeholder="ادخل نهاية الخصم " name="end_discount">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('end_discount'))
                                                    <span class="text-danger">{{ $errors->first('end_discount') }}</span>
                                                @endif
                                            </div>
                                            <input type="hidden" value="{{$program->id}}" name="id_program" >
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

        
    </div>
@endsection