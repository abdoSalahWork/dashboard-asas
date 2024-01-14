@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
     اكثؤ المؤسسات طلبا
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
<style>
    .rating .checked{
        color: #ffb400 !important;
    }
    .rating .fa{
        color: #a3a3a3;
    }
</style>

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
                اكثر المؤسسات اشتراكا
                <small>عرض اكثر 50</small>
              </h3>
             </div>
             <div class="card-toolbar">
                
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>الاسم</th> --}}
                            <th>رقم الهاتف</th>
                            <th>اسم الشركة</th>
                            <th>المعرف الخاص  بالمؤسسة</th>
                            <th>الحالة</th>
                            <th> عدد البرامج المشترك بها</th>
                            <th>التقييم</th>
                            {{-- <th></th> --}}
    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1;?>
                        @foreach ($arr_top_facility as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                {{-- <td>{{$item[0]->name}}</td> <!--name_corporation--> --}}
                                <td>{{$item[0]->phone}}</td>
                                <td>{{$item[0]->name_corporation}}</td>

                                <td class="text-danger font-weight-bold">{{$item[0]->fa_id}}</td>
                                <td>
                                    @if ($item[0]->is_deleted == 0)
                                        <span class="badge badge-success">مفعل</span>
                                    @else
                                        <span class="badge badge-danger">غير مفعل</span>
                                    @endif
                                </td>
   
                                <td>
                                        {{$item[0]->programCount}}
                                </td>
                                <td>
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
        
                                            <div class="rating-label me-2 ">
                                                <span class="fa fa-star @if($item[0]->rate_total > $i) checked @endif"></span>
                                            </div>
                                        @endfor
     
                                    </div>
                                </td>

                                {{-- <td>
                                    <a href="{{URL('admin/facilityAdmin/edit')}}/{{$item[0]->fa_id}}" class="btn btn-sm btn-primary">
                                        فتح
                                    </a>
                                </td> --}}
        
                            </tr>
      

                        @endforeach
                        
                    </tbody>
                </table>
                {{-- {!! $facility->links() !!} --}}
                    {{-- {{$facility->links('vendor.pagination.bootstrap-4')}} --}}
         </div>
        </div>
    </div>

@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();


        $(document).ready( function () {
        $('.table').DataTable({
            dom: "Blfrtip",
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }] ,
        });
    } );
    </script>


{{-- <script>
    var x = document.getElementById("demo");
    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
      

      $("#latitude").val(position.coords.latitude);
    $("#longitude").val(position.coords.longitude);
    }

    getLocation();
    </script> --}}


@endsection