@extends('admin.layout.main')
@section('title', 'طلبات الطلاب')

@section('content')
    <div class="container">
        @if (Session::has('success'))
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
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModal">تعديل الحالة</h5>

                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="Post" id="updateForm" class="row"
                        action="{{ route('reservations.updat') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- First Column -->
                        <input type="hidden" name="record_id" id="record_id">
                        <div class="col-md-12">
                        
                            <!-- Type Select Box -->
                            <div class="form-group">
                                <label for="type">النوع</label>
                                <select class="form-select" id="id_reservation_statuses" name="id_reservation_statuses">
                                   @foreach (\App\Models\Model\Reservation_status::get() as $status)
                                   <option value="{{ $status->id }}">{{ $status->status_ar }}
                                   </option>
                               @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                        </div>
                       
                </div>
                <div class="modal-footer">
                    <button type="submit" id=""
                    class="btn btn-primary">حفظ</button>
            </form>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>  
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
                            <th>اسم الطالب</th>
                            <th>اسم الاب</th>
                            <th> اسم المؤسسه</th>
                            <th>اسم البرنامج</th>
                            <th>الحالة</th>
                            <th>تاريخ تقديم الطلب</th>
                            {{-- <th>تعديل الحالة</th> --}}
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
        $(function() {

            var table = $('.table').DataTable({
                dom: "Blfrtip",
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ URL('/admin/facilityAdmin/reservations_list') }}",
                columns: [{
                        data: 'child_name'
                    },
                    {
                        data: 'father_name2'
                    },
                    {
                        data: 'name_company'
                    },
                    {
                        data: 'program_name_ar'
                    },
                    {
                        data: 'reservationStatus_status_ar'
                    },
                    {
                        data: 'created_at'
                    },
                    
                    {
                        data: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

        });
        $(document).ready(function()
            {
                $('.table').on('click', '.edit-record', function() {
                    var recordId = $(this).data('record-id');

                    $.ajax({
                        url: '/admin/get-record/' + recordId, 
                        type: 'GET',
                        dataType: 'json', 
                        success: function(data) {
                            console.log(data.id_reservation_statuses);
                            $('#record_id').val(data.id);                            
                            $('#id_reservation_statuses').val(data.id_reservation_statuses);                            
                            $('#updateModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });

            });
    </script>
@endsection
