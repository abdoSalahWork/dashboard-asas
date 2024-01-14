@extends('facility_owner.layout.main')
@section('title', 'طلبات الطلاب')

@section('content')
    <div class="container">
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

        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                طلبات الطلاب
                <small>عرض الجميع</small>
              </h3>
             </div>
             {{-- <div class="card-toolbar">
                <a href="{{URL("/facility_m/programs/create")}}" class="btn btn-sm btn-light-primary font-weight-bold">
                    <i class="flaticon2-cube"></i> اضف جديد
                </a>
            </div> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>اسم الاب</th>
                            <th>اسم البرنامج</th>
                            <th>الحالة</th>
                            <th></th>
                            <th></th>
    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($my_reservation as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$item->child_name}}</td>
                                <td>{{$item->father_name2}}</td>
                                <td>{{$item->program_name_ar}}</td>
                                <td>{{$item->reservationStatus_status_ar}}</td>
                                <td>
                                    <a href="{{URL('facility_m/children_propgram',$item->childProg_id)}}" type="button" class="btn btn-primary" >
                                        فتح                                       
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->childProg_id}}">حذف</a>
                                </td>
    
                               
        
                            </tr>

    
    
                            <!-- Modal delete-->
                            <div class="modal " id="exampleModalScrollableDelete{{$item->childProg_id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                        <form action="{{URL('/facility_m/children_propgram',$item->childProg_id)}}" method="post">
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
                {{$my_reservation->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>





    </div>



@endsection