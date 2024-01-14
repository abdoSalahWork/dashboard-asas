@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'الاتفاقيات')
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

    <div class="card card-custom">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">اضافة اتفاقية جديدة</h3>
         </div>

        </div>
        <div class="card-body">
         <div class="tab-content">
            <form action="{{URL('/admin/agreement')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">اسم الاتفاقية عربي
                                <span class="required"></span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('name_ar') is-invalid @enderror"  value="{{ old('name_ar') }}" placeholder="اسم الاتفاقية" name="name_ar" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('name_ar'))
                                <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                            @endif
                        </div>
    
    
                        <div class="form-group">
                            <label for="exampleTextarea">وصف قصير عربي</label>
                            <span class="required"></span>
                            <textarea  name = "short_description_ar" class="form-control form-control-solid @error('short_description_ar') is-invalid @enderror" rows="3" required>{{ old('short_description_ar') }}</textarea>
                            @if ($errors->has('short_description_ar'))
                                <span class="text-danger">{{ $errors->first('short_description_ar') }}</span>
                             @endif
                        </div>
    
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-title">
                                        وصف الاتفاقية عربي
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <textarea name="description_ar" id="kt-ckeditor-5" class=" @error('description_ar') is-invalid @enderror" required>
                                    {{ old('description_ar') }}
                                </textarea>
                                @if ($errors->has('short_description_ar'))
                                    <span class="text-danger">{{ $errors->first('description_ar') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">اسم الاتفاقية إنجليزي
                            <span class="required"></span>
                            {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}" placeholder="اسم الاتفاقية" name="name_en" required>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                        @if ($errors->has('name_en'))
                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="exampleTextarea">وصف قصير انجليزي</label>
                        <span class="required"></span>
                        <textarea  name = "short_description_en" class="form-control form-control-solid @error('short_description_en') is-invalid @enderror" rows="3" required>{{ old('short_description_en') }}</textarea>
                        @if ($errors->has('short_description_en'))
                            <span class="text-danger">{{ $errors->first('short_description_en') }}</span>
                         @endif
                    </div>



                    
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-title">
                                    وصف الاتفاقية انجليزي
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea name="description_en" id="kt-ckeditor-5-2" class=" @error('description_en') is-invalid @enderror" required>
                                {{ old('description_en') }}
                            </textarea>
                            @if ($errors->has('description_en'))
                                <span class="text-danger">{{ $errors->first('description_en') }}</span>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>

                    





                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                        <button type="reset" class="btn btn-secondary">تفريغ</button>
                    </div>


            </form>

         </div>
        </div>
       </div>
</div>

@endsection
@section('scripts')
    <script>
        // Class definition

        var KTCkeditor = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create( document.querySelector( '#kt-ckeditor-5' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            var demos2 = function () {
                ClassicEditor
                    .create( document.querySelector( '#kt-ckeditor-5-2' ) )
                    .then( editor => {
                        console.log( editor );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }

            return {
                // public functions
                init: function() {
                    demos();
                    demos2();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTCkeditor.init();
        });


        function display_my(){
            document.getElementById('kt_tab_pane_4_1').style.display = "none";
        }
        function show_my(){
            document.getElementById('kt_tab_pane_4_1').style.display = "block";
        }
    </script>
@endsection
