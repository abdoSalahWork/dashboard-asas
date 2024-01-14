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
            مشرفين
            <small>عرض الجميع</small>
            
          </h3>
         </div>
         <div class="card-toolbar">
            <a class="btn btn-sm btn-light-success font-weight-bold mr-1" href="{{URL('register')}}">اضف جديد</a>

         </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الايميل</th>
                        <th>النوع</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;?>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->type}}</td>

                            <td>
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable{{$item->id}}" @if($item->id == 1) disabled @endif>
                                    تعديل                                       
                                </button>
                            </td>
                            <td>
                                @if($item->id != 1) 
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}" >حذف</a>
                                @endif
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
                                    <form action="{{URL('/admin/updateAdmin',$item->id)}}" method="post">
                                        @csrf
                                        <div class="modal-body" style="height: 300px;">
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> الاسم</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{$item->name}}" placeholder="ادخل الاسم" name="name" required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('name'))
                                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                                  @endif
                                            </div>
                                        
                                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                    <span class="required"> البريد الالكتروني</span>
                                                    {{-- <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror" value="{{$item->email}}" placeholder="ادخل البريد الالكتروني" name="email" required>
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                                @if ($errors->has('email'))
                                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                                  @endif
                                            </div>

                                            <div class="form-group row">
                                                <label class="required">النوع</label>
                                                <div class="col-12">
                                                    <select name="type" class="form-control form-control-solid">
                                                        <option value="admin" @if($item->type == 'admin') selected @endif>مشرف</option>
                                                        <option value="data_entry" @if($item->type == 'data_entry') selected @endif>مدخل بيانات</option>
                                                    </select>
                                                    @if ($errors->has('type'))
                                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                                @endif
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
                                    <form action="{{URL('/admin/deleteAdmin',$item->id)}}" method="get">
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
            {{$users->links('vendor.pagination.bootstrap-4')}}

        </div>
</div>


@endsection