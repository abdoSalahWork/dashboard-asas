@extends('facility_owner.layout.main')
@section('title')
    الاتفاقيات
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
                    تفاصيل الاتفاقية

                {{-- <small>عرض الجميع</small> --}}
              </h3>
             </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" >
                    <tr>
                        <th>#</th>
                        <th scope="col">اسم الاتفاقية</th>
                        <td>{{$agreements_facility->name_en}}</td>
                        <td>{{$agreements_facility->name_ar}}</td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>تاريخ النهاية</th>
                        <td>{{$agreements_facility->end_date}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>الحالة </th>
                        <td>{{$agreements_facility->status}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>وصف قصير</th>
                        <td>{{$agreements_facility->short_description_en}}</td>
                        <td>{{$agreements_facility->short_description_ar}}</td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th> description</th>
                        <td>{!!$agreements_facility->description_en!!}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>وصف</th>
                        <td>{!!$agreements_facility->description_ar!!}</td>
                        <td></td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
@endsection