@extends('admin.layout.main')
@section('title', ' محادثات')

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
                محادثه
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
                            <th>اسم المؤسسه</th>
                            <th>اسم الاب</th>
                            <th> تاريخ اخر محادثة</th>
                            <th></th>
    
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {{-- {{$reservations->links('vendor.pagination.bootstrap-4')}} --}}
            </div>
        </div>





    </div>



@endsection
@section('scripts')
    
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
          ajax: "{{URL('/admin/main/chat')}}",
          columns: [
              {data: 'name_corporation'},
              {data: 'fatherName'},
              {data: 'created_at'},
              {
                data: 'action',
                orderable: true,
                searchable: true
              }
          ]
      });
  
    });
</script>
@endsection