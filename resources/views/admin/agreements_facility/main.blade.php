@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'اتفاقيات المؤسسات')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif
<div class="container">

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            اضف اتفاقية للوؤسسات
            <small>اضف جديد</small>
          </h3>
         </div>
        </div>
        <div class="card-body">

            <form action="{{url('/admin/agreements_facility')}}" method="post">
                @csrf

                <div class="form-group row">
                    <label class="col-2 col-form-label">الاتفاقية</label>
                    <div class="col-10">
                        <select name="id_agreement" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($agreements as $item)
                                <option value="{{$item->id}}">{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-2 col-form-label">المؤسسة</label>
                    <div class="col-10">
                        <select name="id_facility" class="js-example-disabled-results form-control form-control-solid">
                            @foreach ($facility_owner as $item)
                                <option value="{{$item->id}}">{{$item->name_corporation}}  ({{$item->id}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            
                <div class="form-group row">
                    <label class="col-2 col-form-label">الحالة</label>
                    <div class="col-10">
                        <select name="status" class="form-control form-control-solid">
                            <option value="مفعلة">مفعلة</option>
                            <option value="غير مفعلة">غير مفعلة</option>
                            <option value="مفعلة مؤقتا">مفعلى مؤقتا</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">تاريخ النهاية</label>
                    <div class="col-10">
                        <input class="form-control" name="end_date" type="date" value="" id="example-date-input">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">اضف</button>

            </form>

        </div>
    </div>

    <br>

    <div class="card card-custom gutter-b">
        <div class="card-header">
         <div class="card-title">
          <h3 class="card-label">
            {{-- اتفاقيات المؤسسات --}}
            <small>عرض الجميع</small>
          </h3>
         </div>
        </div>
        <div class="card-body">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">  
                                      {{-- اتفاقيات المؤسسات --}}
                            <form action="{{URL('/admin/agreements_facility/search')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="agreement" class="form-control " placeholder="البحث في المؤسسات..." required>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary btn-sm" type="submit">Go!</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </span>
                        {{-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 new products</span> --}}
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--begin::Menu 2-->
                        {{-- <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div> --}}
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="border-0 text-center">
                                    <th class="p-0">#</th>
                                    <th class="p-0">الاتفاقية</th>
                                    <th class="p-0">المؤسسة</th>
                                    <th class="p-0 ">سارية حتى</th>
                                    <th class="p-0 ">الحالة</th>
                                    <th class="p-0 ">محذوف</th>
                                    <th class="p-0 min-w-100px text-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <?php $counter = 1;?>
                                @foreach ($agreements_facility as $item)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                {{-- <div class="symbol symbol-45px me-5">
                                                    <img alt="Pic" src="assets/media/avatars/150-1.jpg">
                                                </div> --}}
                                                <!--end::Avatar-->
                                                <!--begin::Name-->
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="{{URL('/admin/agreement',$item->ag_id)}}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{$item->name_ar}}</a>
                                                    {{-- <a href="#" class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                                    <span class="text-dark">Email</span>: e.smith@kpmg.com.au</a> --}}
                                                </div>
                                                <!--end::Name-->
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{$item->name_corporation}}</a>
                                            {{-- <span class="text-muted fw-bold text-muted d-block fs-7">Paid</span> --}}
                                        </td>
                                        <td class="text-muted fw-bold text-end">{{$item->end_date}}</td>
                                        <td class="text-end">
                                                <span class="badge badge-light-success">{{$item->status}}</span>
                                        </td>
                                        <td class="text-muted fw-bold text-end">
                                            @if($item->is_deleted == 0)
                                                <span class="badge badge-light-success">غير محذزف</span>
                                            @else
                                                <span class="badge badge-light-danger">محذوف</span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a> --}}
                                            <a href="{{route('agreements_facility.edit',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>

                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-toggle="modal" data-target="#exampleModalScrollableDelete{{$item->id}}">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
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
                                                <form action="{{URL('/admin/agreements_facility',$item->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                                                        @if($item->is_deleted == 1)
                                                            <button type="submit" class="btn btn-primary font-weight-bold">ارجاع</button>  
                                                        @else
                                                            <button type="submit" class="btn btn-danger font-weight-bold">حذف</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->

                        @if($agreements_facility instanceof \Illuminate\Pagination\AbstractPaginator)
                            {{$agreements_facility->links('vendor.pagination.bootstrap-4')}}
                        @else
                        <a href="{{URL('/admin/agreements_facility')}}" class="btn  btn-bg-light btn-active-color-primary">عرض الكل</a>

                        @endif
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
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
@endsection