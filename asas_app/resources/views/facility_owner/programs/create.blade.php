@extends('facility_owner.layout.main')
@section('title')
انشاء برنامج 
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
        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                البرامج
                <small>اضف جديد</small>
              </h3>
             </div>
            </div>
            <div class="card-body">
    
             <form action="{{url('/facility_m/programs')}}" method="post" enctype="multipart/form-data">
                @csrf
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
                            <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}" required placeholder=" Enter the name" name="name_en">
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
                            <textarea type="text" class="form-control form-control-solid @error('description_en') is-invalid @enderror"  value="{{ old('description_en') }}" required placeholder=" Enter the description" name="description_en"></textarea>
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
                            <input type="text" class="form-control form-control-solid @error('age_conditions_en') is-invalid @enderror"  value="{{ old('age_conditions_en') }}" required placeholder=" Enter the Age conditions" name="age_conditions_en">
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
                            <textarea type="text" class="form-control form-control-solid @error('other_conditions_en') is-invalid @enderror"  value="{{ old('other_conditions_en') }}" placeholder="Enter the Other Conditions" name="other_conditions_en"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('other_conditions_en'))
                                <span class="text-danger">{{ $errors->first('other_conditions_en') }}</span>
                            @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span >Price note</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <textarea type="text" class="form-control form-control-solid @error('price_note_en') is-invalid @enderror"  value="{{ old('price_note_en') }}" placeholder="Enter price note" name="price_note_en"></textarea>
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
                            <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror"  value="{{ old('name_ar') }}" required placeholder=" ادخل الاسم" name="name_ar">
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
                            <textarea type="text" class="form-control form-control-solid @error('description_ar') is-invalid @enderror"  value="{{ old('description_ar') }}" required placeholder=" ادخل الوصف" name="description_ar"></textarea>
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
                            <input type="text" class="form-control form-control-solid @error('age_conditions_ar') is-invalid @enderror"  value="{{ old('age_conditions_ar') }}" required placeholder="ادخل شروط العمر" name="age_conditions_ar">
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
                            <textarea type="text" class="form-control form-control-solid @error('other_conditions_ar') is-invalid @enderror"  value="{{ old('other_conditions_ar') }}" placeholder=" ادخل الشروط الاخرى" name="other_conditions_ar"></textarea>
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
                            <textarea type="text" class="form-control form-control-solid @error('price_note_ar') is-invalid @enderror"  value="{{ old('price_note_ar') }}" placeholder="ادخل ملاحظة السعر" name="price_note_ar"></textarea>
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
                                <option value="{{$item->id}}">{{$item->time_type_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label" >نوع البرنامج</label>
                    <div class="col-10">
                        <select name="id_typeProgram" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($program_types as $item)
                                <option value="{{$item->id}}">{{$item->program_type_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">  السعر </span>
                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                    </label>
                    <!--end::Label-->
                    <input type="number" class="form-control form-control-solid @error('price_main') is-invalid @enderror"  value="{{ old('price_main') }}" required placeholder=" ادخل السعر" name="price_main">
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
                    <textarea type="text" class="form-control form-control-solid @error('other_fute') is-invalid @enderror"  value="{{ old('other_fute') }}" placeholder=" ادخل المزايا الاخرى" name="other_fute"></textarea>
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
                    <input type="text" class="form-control form-control-solid @error('url_viedo') is-invalid @enderror"  value="{{ old('url_viedo') }}"  placeholder=" ادخل الرابط" name="url_viedo">
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
                                <option value="{{$item->id}}">{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


    
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">  صور </span>
                        {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control form-control-solid @error('image') is-invalid @enderror" value="{{ old('image') }}" placeholder="image" name="image[]" multiple required>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                    @if ($errors->has('image'))
                          <span class="text-danger">{{ $errors->first('image') }}</span>
                      @endif
                </div>
    
    
    
            
                <button type="submit" class="btn btn-primary">اضف</button>
    
             </form>
    
            </div>
        </div>
    </div>
@endsection