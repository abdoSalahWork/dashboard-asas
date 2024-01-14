@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
    اصحاب المؤسسات
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

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
                اصحاب المؤسسات
                <small>عرض الجميع</small>
              </h3>
             </div>
             <div class="card-toolbar">
                <a href="{{URL('admin/facilityAdmin/create')}}" class="btn btn-sm btn-light-primary font-weight-bold mr-1">
                    اضافة
                </a>

                <a class="btn btn-sm btn-light-success font-weight-bold mr-1"  data-toggle="modal" data-target="#exampleModalScrollableDelete">
                    {{-- <i class="fa fa-plus"></i> --}}
                    تفعيل الكل
                </a>

                
            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهاتف</th>
                            <th>اسم الشركة</th>
                            <th>المعرف الخاص  بالمؤسسة</th>
                            <th>الحالة</th>
                            <th>تاريخ الانشاء</th>
                            
                            <th></th>
                            <th></th>
    
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
                {{-- {!! $facility->links() !!} --}}
                    {{-- {{$facility->links('vendor.pagination.bootstrap-4')}} --}}
         </div>
        </div>
    </div>

        <!-- Modal active all-->
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
                    <form action="{{URL('/admin/facilityAdmin/activeAll')}}" method="post">
                        @csrf
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success font-weight-bold">تفعيل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}


    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
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

    <script type="text/javascript">
        $(function () {
      
          var table = $('.table').DataTable({
            dom: "Blfrtip",
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }] ,
              processing: true,
              serverSide: true,
              ajax: "{{URL('/admin/showFromAdminList')}}",
              columns: [
                  {data: 'name'},
                  {data: 'phone'},
                  {data: 'name_corporation'},
                  {data: 'id'},
                  {
                    data: 'is_deleted',
                    orderable: true,
                    searchable: true
                },
                  {data: 'created_at'},
                  {
                      data: 'action', 
                      orderable: true, 
                      searchable: true
                  },
                  {
                    data: 'rate',
                    orderable: true,
                    searchable: true
                  }
            ],
          });
      
        });

        // $('.table').dataTable( {
        //     "paging": true
        // } );
    </script>
@endsection