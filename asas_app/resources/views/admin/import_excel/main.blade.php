@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'استيراد')
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
@endif
<div class="container">

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            استيراد بيانات 
            <small> من ملف اكسل</small>
          </h3>
         </div>
        </div>
        <div class="card-body">

         <form action="{{url('/admin/import_data')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required"> ملف المؤسسات</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="file" class="form-control form-control-solid @error('file') is-invalid @enderror"  value="{{ old('file') }}" required placeholder=" ادخل ملف المؤسسات" name="file">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('file'))
                      <span class="text-danger">{{ $errors->first('file') }}</span>
                  @endif
            </div>
        
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  ملف البرامج</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="file" class="form-control form-control-solid @error('file_program') is-invalid @enderror" value="{{ old('file_program') }}" placeholder="  ادخل ملف البرامج" name="file_program">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('file_program'))
                      <span class="text-danger">{{ $errors->first('file_program') }}</span>
                  @endif
            </div>
            <button type="submit" class="btn btn-primary">اضف</button>

         </form>

        </div>
    </div>

    <br>

    {{-- <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            انواع البرامج           
            <small>عرض الجميع</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العملة انجليزي</th>
                        <th>  العملة عربي</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;?>
                    @foreach ($coins as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->coins_name_en}}</td>
                            <td>{{$item->coins_name_ar}}</td>
          
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}">
                                    تعديل                                       
                                </button>
                            </td>
                            <td>
                                <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div> --}}

</div>

@endsection