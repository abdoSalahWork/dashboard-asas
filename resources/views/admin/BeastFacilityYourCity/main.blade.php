@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'افضل العرضو لمدينتك')
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
            افضل العروض لمدينتك          
           <small>اضف جديد</small>
          </h3>
         </div>
        </div>
        <div class="card-body">

         <form action="{{url('/admin/beastFacilityYourCity')}}" method="post">
            @csrf
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required"> المؤسسة</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->

                <select name="Facility_Id" class="js-example-disabled-results js-example-disabled-results-create form-control form-control-solid">
                    @foreach ($facility_owner as $item)
                        <option value="{{$item->id}}">{{$item->name_corporation}}  ({{$item->id}})</option>
                    @endforeach
                </select>

                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('Facility_Id'))
                      <span class="text-danger">{{ $errors->first('Facility_Id') }}</span>
                  @endif
            </div>
        
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المدينة</span>
                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                </label>
                <!--end::Label-->
                <select name="City_Id" class="js-example-disabled-results js-example-disabled-results-create form-control form-control-solid  @error('City_Id') is-invalid @enderror">
                    @foreach ($cities as $item)
                        <option value="{{$item->id}}">{{$item->name_ar}}</option>
                    @endforeach
                </select>
                <div class="fv-plugins-message-container invalid-feedback"></div>
                @if ($errors->has('City_Id'))
                      <span class="text-danger">{{ $errors->first('City_Id') }}</span>
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
            افضل العروض في مدينتك          
            <small>عرض الجميع</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المؤسسة</th>
                        <th>المدنة</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->name_corporation}}</td>
                            <td>{{$item->cityName}}</td>
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
                                    <form action="{{URL('/admin/beastFacilityYourCity',$item->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body" style="height: 300px;">
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> المؤسسة</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                
                                                <select name="Facility_Id" class="js-example-disabled-results form-control form-control-solid  @error('Facility_Id') is-invalid @enderror">
                                                    @foreach ($facility_owner as $itemFac)
                                                        <option value="{{$itemFac->id}}" @if($item->Facility_Id == $itemFac->id) checked @endif>{{$itemFac->name_corporation}}  ({{$itemFac->id}})</option>
                                                    @endforeach
                                                </select>
                                
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('Facility_Id'))
                                                      <span class="text-danger">{{ $errors->first('Facility_Id') }}</span>
                                                  @endif
                                            </div>
                                        
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required">المدينة</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select name="City_Id" class="js-example-disabled-results form-control form-control-solid  @error('City_Id') is-invalid @enderror">
                                                    @foreach ($cities as $itemCity)
                                                        <option value="{{$itemCity->id}}" @if($itemCity->id == $item->City_Id) checked @endif>{{$itemCity->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('City_Id'))
                                                      <span class="text-danger">{{ $errors->first('City_Id') }}</span>
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
                                    <form action="{{URL('/admin/beastFacilityYourCity',$item->id)}}" method="post">
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
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results-create");
        $disabledResults.select2();

    </script>
@endsection