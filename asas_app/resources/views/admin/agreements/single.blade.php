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
    
<ul class="nav">
    <li class="nav-item">
        <a class="nav-link active" href="{{route('agreement.edit',$agreement->id)}}">تعديل</a>
    </li>
    <li class="nav-item">
        @if($agreement->is_deleted == 0)
            <a class="nav-link text-danger" href="#" data-toggle="modal" data-target="#exampleModalScrollableDelete">حذف</a>
        @else
            <a class="nav-link text-danger" href="#" data-toggle="modal" data-target="#exampleModalScrollableDelete">تفعيل</a>
        @endif
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{URL('/admin/agreement')}}">رجوع</a>
    </li>
</ul>


    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
             
          <h3 class="card-label">
           {{$agreement->name_ar}}
          </h3>
         </div>
        </div>
        <div class="card-body">
            {{$agreement->short_description_ar}}
            <hr>
            {!!$agreement->description_ar!!}
        </div>
    </div>

    <br>

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
           {{$agreement->name_en}}
          </h3>
         </div>
        </div>
        <div class="card-body">
            {{$agreement->short_description_en}}
            <hr>
            {!!$agreement->description_en!!}
        </div>
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
            <form action="{{URL('/admin/agreement',$agreement->id)}}" method="post">
                @method('delete')
                @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                    @if($agreement->is_deleted == 1)
                        <button type="submit" class="btn btn-primary font-weight-bold">ارجاع</button>  
                    @else
                        <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection