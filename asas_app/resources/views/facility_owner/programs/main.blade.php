@extends('facility_owner.layout.main')
@section('title')
    البرامج
@endsection
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
                البرامج
                <small>عرض الجميع</small>
              </h3>
             </div>
             <div class="card-toolbar">
                <a href="{{URL("/facility_m/programs/create")}}" class="btn btn-sm btn-light-primary font-weight-bold">
                    <i class="flaticon2-cube"></i> اضف جديد
                </a>
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>نوع الدوام</th>
                            <th>نوع البرنامج</th>
                            <th>السعر ب{{$coins->coins_name_ar}}</th>
                            <th>الترتيب</th>

                            <th></th>
                            <th></th>
    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($programs as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$item->name_ar}}</td>
                                <td>{{$item->program_type_ar}}</td>
                                <td>{{$item->time_type_ar}}</td>
                                <td>{{$item->price_main * $coins->dollar}}</td>
                                <td>{{$item->sort}}</td>

                                <td>
                                    <a href="{{route('programs.edit',$item->id)}}" type="button" class="btn btn-primary" >
                                        فتح                                       
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-hover-bg-danger btn-text-danger btn-hover-text-white border-0 font-weight-bold mr-2" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}">حذف</a>
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
                                        <form action="{{URL('/facility_m/programs',$item->id)}}" method="post">
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
                {{$programs->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
@endsection
