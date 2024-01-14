@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
       المؤسسات و البرامج
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
                المؤسسات و البرامج
                <small>الكل</small>
              </h3>
             </div>
             <div class="card-toolbar">
                <a href="{{URL('/admin/import_data')}}" class="btn btn-sm btn-light-primary font-weight-bold mr-1">
                    استيراد بيانات
                </a>
                <a href="{{URL('/admin/facilityAdmin/create')}}" class="btn btn-sm btn-light-primary font-weight-bold mr-1">
                مؤسسة جديدة
                </a>

            </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>رقم الهاتف</th>
                            <th>اسم الشركة</th>
                            <th>نوع المؤسسة</th>
                            <th>عدد البرامج</th>
                            <th>الحالة</th>
                            <th>المعرف</th>
                            <th>التقييم</th>
                            <th>خطوط العرض و الطول</th>
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

@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script>
    var $disabledResults = $(".js-example-disabled-results");
    $disabledResults.select2();

    $(function () {
        $('.table').DataTable({
            dom: "Blfrtip",
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            processing: true,
            serverSide: true,
            ajax: "{{ URL('/admin/facilityAdmin/facility_program') }}",
            columns: [
                { data: 'phone' },
                { data: 'name_corporation' },
                {
                    data: 'company_type',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'program_count',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'is_deleted',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'rate',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'longLat',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    orderable: true,
                    searchable: true
                }
            ]
        });
    });
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
