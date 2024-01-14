@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
    الاباء
@endsection
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
                اباء
                <small>عرض الجميع</small>
              </h3>
             </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهاتف</th>
                            <th>الحاله</th>
                            <th></th>
    
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                {{-- {{$father->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
    </div>

@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
    </script>


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
          ajax: "{{ URL('admin/fatherAdminList') }}",
          columns: [
              {data: 'name'},
              {data: 'phone'},
              {
                data: 'is_deleted',
                orderable: true,
                searchable: true
            },
              {
                  data: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
  
    });
  </script>
@endsection