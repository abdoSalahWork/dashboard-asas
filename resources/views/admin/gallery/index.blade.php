@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
    معرض الصور
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

        <div id="kt_content_container " class="container-xxl">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                    معرض الصور
                    <small>اضف جديد</small>
                  </h3>
                 </div>
                </div>
                <div class="card-body">
        
                 <form action="{{URL('/admin/media')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">الصورة</span>
                                
                            </label>
                            <!--end::Label-->
                            <input type="file" class="form-control form-control-solid  @error('media') is-invalid @enderror" value="{{ old('media') }}" placeholder="الصورة" name="media[]" multiple required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('media'))
                                <span class="text-danger">{{ $errors->first('media') }}</span>
                            @endif
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">النوع</span>
                                    
                                </label>
                                <!--end::Label-->
                                <select class="form-control form-control-solid" name="table_name" required>
                                    <option value="company">مؤسسة</option>
                                    <option value="programs">برنامج</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                
                        <input type="hidden" name="id_" value="-">
                    <button type="submit" class="btn btn-primary">اضف</button>
        
                 </form>
        
                </div>
            </div>



            <div class="card card-custom gutter-b" id="gallery">
                <div class="card-header">
                 <div class="card-title">
                  <h3 class="card-label">
                        <a href="{{URL('admin/media/type/company#gallery')}}" class="text-gray-800 text-hover-primary mx-2">
                            <input class="btn @if($type == 'company') btn-secondary @else btn-light @endif" type="button" name="inlineRadioOptions" value="صور المؤسسات">
                        </a>

                        <a href="{{URL('admin/media/type/programs#gallery')}}" class="text-gray-800 text-hover-primary ">
                            <input class="btn @if($type == 'programs') btn-secondary @else btn-light @endif" type="button" name="inlineRadioOptions" id="inlineRadio2" value="صور البرامج">
                        </a>
                  </h3>
                 </div>
                </div>
                @if(!$medias == false)
                    <div class="card-body">
                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9" >
                            @foreach ($medias as $media)
                                <!--begin::Col-->
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <!--begin::Card-->
                                    <div class="card h-100">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <!--begin::Name-->
                                                <!--begin::Image-->
                                                <div class="symbol symbol-75px mb-5">
                                                    <img src="{{asset('assets/image')}}/{{$media->table_name}}/{{$media->media}}" alt="">
                                                </div>
                                                <!--end::Image-->
                                                <!--begin::Title-->
                                                <div class="fs-5 fw-bolder mb-2">{{$media->media}}</div>
                                                <!--end::Title-->
                                            <!--end::Name-->
                                            <!--begin::Description-->
                                            <div class="fs-7 fw-bold text-gray-400">{{$media->id}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->
                            @endforeach
                        </div>

                    </div>
                    {{$medias->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>


        </div>




    </div>

@endsection
@section('scripts')

@endsection
