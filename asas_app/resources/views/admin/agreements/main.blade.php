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
                   <span class="card-icon">
                       <i class="flaticon2-chat-1 text-primary"></i>
                   </span>
          <h3 class="card-label">
           الاتفاقيات
          </h3>
         </div>
               <div class="card-toolbar">
                   <a href="{{URL('/admin/agreement/create')}}" class="btn btn-sm btn-light-primary font-weight-bold">
                       <i class="flaticon2-cube"></i> اضف جديد
                   </a>
               </div>
        </div>
        <div class="card-body">
               <div data-scroll="true" data-height="200">
                    <div class="row">
                        @foreach ($agreements as $item)
                            <div class="col-lg-4 col-md-6 col-sm-12">

                                <div class="card card-custom gutter-b bg-secondary" style="margin: 10px 0px;">
                                    <div class="card-header">
                                    <div class="card-title">
                                    <h3 class="card-label">
                                        {{$item->name_ar}}
                                    <small>{{$item->name_en}}</small>
                                    </h3>
                                    </div>
                                    </div>
                                    <div class="card-body">
                                        {{$item->short_description_ar}}
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="{{URL('/admin/agreement', $item->id)}}" class="btn btn-light-primary font-weight-bold">تفاصيل</a>

                                        @if($item->is_deleted == 1)
                                            <a class="btn text-danger font-weight-bold">محذوف</a>
                                         @endif   

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    

               </div>
        </div>
           <div class="card-footer">
                {{$agreements->links('vendor.pagination.bootstrap-4')}}
            </div>
    </div>

</div>

@endsection

