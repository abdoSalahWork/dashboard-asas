@extends('admin.layout.main')
@section('title', 'حجز')

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
        <?php  
            $total_price = 0;
            $total_service_price = 0;
            $total_discount = 0;

        ?>
        <div class="card card-custom gutter-b">
            <div class="card-header">
             <div class="card-title">
              <h3 class="card-label">
                طلب 
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
                    <tr>
                        <th>الاسم</th>
                        <td>{{$reservation->child_name}}</td>
                    </tr>
                    <tr>
                        <th>اسم الاب</th>
                        <td>{{$reservation->father_name2}}</td>
                    </tr>
                    <tr>
                        <th>اسم البرنامج</th>
                        <td>{{$reservation->program_name_ar}}</td>
                    </tr>
                    <tr>
                        <th>سعر البرنامج</th>
                        <td>{{$reservation->price * $coins->dollar}} {{$coins->coins_name_ar}}</td>
                        <?php $total_price +=  ($reservation->price * $coins->dollar);?>
                    </tr>

                    <tr>
                        <th>خدمات اخرى</th>
                        <td>{{$reservation->child_name}}</td>
                    </tr>
                    <tr>
                        <th>حالة الحجز</th>
                        <td>
                            {{$reservation->reservationStatus_status_ar}}
                            {{-- <form action="{{URL('facility_m/programChildren/update_reservattions')}}/{{$reservation->childProg_id}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <select class="form-control" id="exampleSelect1" name="id_reservation_statuses">
                                        @foreach ($reservationStatus as $status)
                                            <option @if($status->id == $reservation->reservationStatus_id) selected @endif value="{{$status->id}}"> {{$status->status_ar}}</option>
                                        @endforeach
    
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="تحديث">
                            </form> --}}
                        </td>
                    </tr>
                    <tr>
                        <th>تاريخ الحجز</th>
                        <td>{{$reservation->created_at}}</td>
                    </tr>
 
        

    

                </table>


            </div>
        </div>
        
        <br>
        <br>
        <br>

        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        خدمات اخرى
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
                            <th> الخدمة </th>
                            <th> السعر </th>
                            <th> </th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach($more_service as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->service_ar}}</td>
                            <td>{{$item->price * $coins->dollar}} {{$coins->coins_name_ar}}</td>
                            <?php $total_price +=  ($item->price * $coins->dollar);?>
                            <?php $total_service_price += ($item->price * $coins->dollar)?>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        <br>
        <br>
        <br>



        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        خصومات الحجز 
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
                                <th>نسبة الخصم</th>
                                <th>تاريخ بداية الخصم</th>
                                <th>تاريخ نهاية الخصم</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php $counter = 1;?>
                            @foreach($discount as $discount)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$discount->price_rate_discount}} %</td>
                                <td>{{$discount->start_discount}}</td>
                                <td>{{$discount->end_discount}}</td>
                                <?php $total_discount += $discount->price_rate_discount;?>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div class="card">
            <div class="card-body p-9">
                <div class="fs-2hx fw-bolder">
                    @if($total_discount > 0)
                    <span class="text-success">
                        {{ $total_price_after_discount = $total_price - ($total_price * ($total_discount / 100))}} <span>{{$coins->coins_name_ar}}</span>
                                        <div class="fs-4 fw-bold text-gray-400 mb-7">المبلغ الاجمالي بعد الخصم</div>

                        @endif
                    </span>
                       <span> {{$coins->coins_name_ar}} {{$total_price}} </span>
                        
                  
                </div>
                <div class="fs-4 fw-bold text-gray-400 mb-7">المبلغ الاجمالي  </div>
                <div class="fs-6 d-flex justify-content-between my-4">
                    <div class="fw-bold">  سعر البرنامج</div>
                    <div class="d-flex fw-bolder">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr006.svg-->
                    {{-- <span class="svg-icon svg-icon-3 me-1 svg-icon-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.4 14.8L5.3 6.69999C4.9 6.29999 4.9 5.7 5.3 5.3C5.7 4.9 6.29999 4.9 6.69999 5.3L14.8 13.4L13.4 14.8Z" fill="black"></path>
                            <path opacity="0.3" d="M19.8 8.5L8.5 19.8H18.8C19.4 19.8 19.8 19.4 19.8 18.8V8.5Z" fill="black"></path>
                        </svg>
                    </span> --}}
                    <!--end::Svg Icon-->{{$reservation->price * $coins->dollar}} {{$coins->coins_name_ar}}</div>
                </div>
                <div class="separator separator-dashed"></div>
                <div class="fs-6 d-flex justify-content-between mb-4">
                    <div class="fw-bold">اجمالي سعر الخدمات</div>
                    <div class="d-flex fw-bolder">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
                    {{-- <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black"></path>
                            <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black"></path>
                        </svg>
                    </span> --}}
                    <!--end::Svg Icon-->{{$total_service_price}} {{$coins->coins_name_ar}}</div>
                </div>
                <div class="separator separator-dashed"></div>
                <div class="fs-6 d-flex justify-content-between my-4">
                    <div class="fw-bold">خصم</div>
                    <div class="d-flex fw-bolder">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr006.svg-->
                    <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z" fill="black"></path>
                            <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->%{{$total_discount}}</div>
                </div>
                <div class="separator separator-dashed"></div>

            </div>
        </div>



    </div>



@endsection