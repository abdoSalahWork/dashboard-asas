@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'نوع المؤسسة')
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

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            نوع المؤسسات
            <small>اضف جديد</small>
          </h3>
         </div>
        </div>
        <div class="card-body">

         <form action="{{url('/admin/company_type')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  النوع انجليزي</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid @error('type_name_en') is-invalid @enderror"  value="{{ old('type_name_en') }}" required placeholder=" ادخل النوع بالانجليزي" name="type_name_en">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('type_name_en'))
                      <span class="text-danger">{{ $errors->first('type_name_en') }}</span>
                  @endif
            </div>
        
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  النوع عربي</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid @error('type_name_ar') is-invalid @enderror" value="{{ old('type_name_ar') }}" placeholder="  ادخل النوع بالعربي" name="type_name_ar">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('type_name_ar'))
                      <span class="text-danger">{{ $errors->first('type_name_ar') }}</span>
                  @endif
            </div>

            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">الترتيب  </span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="number" class="form-control form-control-solid @error('sort') is-invalid @enderror" value="{{ old('sort') }}" placeholder="   ادخل  الترتيب" name="sort" min="1" required>
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('sort'))
                      <span class="text-danger">{{ $errors->first('sort') }}</span>
                  @endif
            </div>

            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  ايقونة </span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="file" class="form-control form-control-solid @error('icon') is-invalid @enderror" value="{{ old('icon') }}" placeholder="  icon" name="icon">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('icon'))
                      <span class="text-danger">{{ $errors->first('icon') }}</span>
                  @endif
            </div>



        
            <button type="submit" class="btn btn-primary">اضف</button>

         </form>

        </div>
    </div>

    <br>

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            حالات المؤسسات           
            <small>عرض الجميع</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>النوع انجليزي</th>
                        <th>  النوع عربي</th>
                        <th>ايقونة</th>
                        <th>الترتيب</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;?>
                    @foreach ($company_types as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->type_name_en}}</td>
                            <td>{{$item->type_name_ar}}</td>
                            <td>
                                <div class="symbol mr-3">
                                    <img alt="Pic" src="{{asset('assets/image/company_type')}}/{{$item->icon}}"/>
                                </div>
                            </td>
                            <td>{{$item->sort}}</td>
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
                                    <form action="{{URL('/admin/company_type',$item->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body" style="height: 300px;">
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">نوع المؤسسة انجليزي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('type_name_en') is-invalid @enderror"  value="{{$item->type_name_en}}" placeholder="  ادخل النوع بالانجليزي" name="type_name_en">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('type_name_en'))
                                                      <span class="text-danger">{{ $errors->first('type_name_en') }}</span>
                                                  @endif
                                            </div>
                                        
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">نوع البرنامج عربي</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('type_name_ar') is-invalid @enderror" value="{{$item->type_name_ar}}" placeholder="   ادخل النوع بالعربي" name="type_name_ar">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('type_name_ar'))
                                                      <span class="text-danger">{{ $errors->first('type_name_ar') }}</span>
                                                  @endif
                                            </div>



                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">الترتيب  </span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="number" class="form-control form-control-solid @error('sort') is-invalid @enderror" value="{{$item->sort}}" placeholder="   ادخل  الترتيب" name="sort">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('sort'))
                                                      <span class="text-danger">{{ $errors->first('sort') }}</span>
                                                  @endif
                                            </div>


                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">  ايقونة </span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="file" class="form-control form-control-solid @error('icon') is-invalid @enderror" value="{{ old('icon') }}" placeholder="  icon" name="icon">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('icon'))
                                                      <span class="text-danger">{{ $errors->first('icon') }}</span>
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
                                    <form action="{{URL('/admin/company_type',$item->id)}}" method="post">
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
        </div>
    </div>

</div>

@endsection
