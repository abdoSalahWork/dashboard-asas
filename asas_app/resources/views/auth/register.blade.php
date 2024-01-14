@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
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
            مشرف
            <small>اضف جديد</small>
          </h3>
         </div>
        </div>
        <div class="card-body">

         <form action="{{ route('registerCustomAdmin') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  الاسم</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{ old('name') }}" required placeholder="ادخل الاسم" name="name">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
            </div>
        
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">  البريد الالكتروني</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror text-right" value="{{ old('email') }}" placeholder="ادخل البريد الالكتروني" name="email">
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
            </div>

            <div class="form-group row">
                <label class="required">النوع</label>
                <div class="col-12">
                    <select name="type" class="form-control form-control-solid">
                        <option value="admin" >مشرف</option>
                        <option value="data_entry" selected>مدخل بيانات</option>
                    </select>
                    @if ($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                </div>
            </div>

            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">كلمة المرور </span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="ادخل كلمة المرور" name="password" required>
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
            </div>

            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required"> تأكيد كلمة المرور </span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <input type="password" class="form-control form-control-solid " id="password-confirm" placeholder="ادخل تأكيد كلمة المرور" name="password_confirmation" required>
                <div class="fv-plugins-message-container invalid-feedback"></div>

            </div>




        
            <button type="submit" class="btn btn-primary">اضف</button>

         </form>

        </div>
    </div>


    
    <br>






</div>
@endsection
