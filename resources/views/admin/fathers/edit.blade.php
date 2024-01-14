@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
    الاباء
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
        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                اباء
                <small>عرض الجميع</small>
              </h3>
             </div>
             <div class="card-toolbar">
                @if ($father->is_deleted == 0)
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalScrollableDelete">
                    حذف
                </button>
                @else
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalScrollableDelete">
                        تفعيل
                    </button>
                @endif
                <a href="{{ URL('admin/fatherAdmin') }}" class="btn btn-sm btn-primary mr-1">
                    رجوع
                </a>
             </div>
            </div>
            <div class="card-body">
                <form action="{{URL('/admin/father',$father->id)}}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"> الاسم</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{$father->name}}" placeholder="ادخل الاسم" name="name" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('name'))
                                  <span class="text-danger">{{ $errors->first('name') }}</span>
                              @endif
                        </div>
                    
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required"> رقم الهاتف</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid @error('phone') is-invalid @enderror" value="{{$father->phone}}" placeholder="ادخل رقم الهاتف" name="phone" required>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('phone'))
                                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                              @endif
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label">الدولة</label>
                            <div class="col-10">
                                <select name="id_country" class="js-example-disabled-results form-control form-control-solid">
                                    @foreach ($countries as $itemC)
                                        <option value="{{$itemC->id}}" @if($itemC->id == $father->id_country) selected @endif>{{$itemC->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-2 col-form-label">المدينة</label>
                            <div class="col-10">
                                <select name="id_city" class="js-example-disabled-results form-control form-control-solid">
                                    @foreach ($cities as $itemC)
                                        <option value="{{$itemC->id}}" @if($itemC->id == $father->id_city) selected @endif>{{$itemC->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label">العمله</label>
                            <div class="col-10">
                                <select name="id_coins" class="js-example-disabled-results form-control form-control-solid">
                                    @foreach ($coins as $itemC)
                                        <option value="{{$itemC->id}}" @if($itemC->id == $father->id_coins) selected @endif>{{$itemC->coins_name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class=""> اذا لاتريد تغيير كلمة المرور فقط لاتدخل اي قيمة</span>
                                {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                            </label>
                            <!--end::Label-->
                            <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror" value="" placeholder="ادخل كلمةالمرور الجديدة اذا اردت التغيير" name="password">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            @if ($errors->has('password'))
                                  <span class="text-danger">{{ $errors->first('password') }}</span>
                              @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-weight-bold">حفظ</button>
                    </div>
                </form>
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
                        <form action="{{URL('/admin/father',$father->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                @if ($father->is_deleted == 0)
                                    <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                                @else
                                    <button type="submit" class="btn btn-success font-weight-bold">تفعيل</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
    </script>
@endsection