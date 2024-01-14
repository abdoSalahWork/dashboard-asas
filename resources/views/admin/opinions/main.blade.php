@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title')
    اراء
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
            اراء
            <small>عرض الجديد</small>
          </h3>
         </div>
         <div class="card-toolbar">
            <a href="{{URL('admin/opinions-active')}}" class="btn btn-sm btn-light-primary font-weight-bold">
                <i class="flaticon2-cube"></i> قبول الكل
            </a>
        </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>صاحب الراي</th>
                        <th>المؤسسة</th>
                        <th>الرأي</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;?>
                    @foreach ($opinions as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->father_name}}</td>
                            <td>{{$item->name_corporation}}</td>
                            <td>{{$item->opinion}}</td>
                            <td>
                                <a href="{{URL('admin/opinions-active')}}/{{$item->id}}" class="btn btn-primary">قبول</a>
                                <a href="{{URL('admin/opinions-delete')}}/{{$item->id}}" class="btn btn-danger">حذف</a>
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
                                    <form action="{{URL('/admin/deleteAdmin',$item->id)}}" method="get">
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
            {{$opinions->links('vendor.pagination.bootstrap-4') }}
        </div>
</div>

@endsection
@section('scripts')
<script>
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
@endsection 