@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'الاشعارات')
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
                        الاشعارات
                        <small>عرض الجميع</small>

                    </h3>
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light-success font-weight-bold mr-1" href="{{URL('admin/notification')}}">اضف جديد</a>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>المحتوي</th>
                        <th>النوع</th>
                        <th>تاريخ الارسال</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1;?>
                    @foreach ($notifications as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->body}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}" >حذف</a>
                            </td>

                        </tr>


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
                                    <form action="{{URL('/admin/notification/delete',$item->id)}}" method="get">
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
                {{$notifications->links('vendor.pagination.bootstrap-4')}}

            </div>
        </div>


@endsection
