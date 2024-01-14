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
        <div class="row g-6 g-xl-9">
            @foreach ($agreements_facility as $item)
                <div class="col-sm-6 col-xl-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card header-->
                            <div class="card-header flex-nowrap border-0 pt-9">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-45px w-45px bg-light me-5">
                                        {{-- <img src="" alt="image" class="p-3"> --}}
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="{{URL('/facility_m/agreements_facility/my/id/')}}/{{$item->id}}" class="fs-4 fw-bold text-hover-primary text-gray-600 m-0">{{$item->name_ar}}</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar m-0">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary">
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

                                    <!--end::Menu-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                                <!--begin::Heading-->
                                <div class="fw-bolder mb-3">{{$item->short_description_ar}}</div>
                                <!--end::Heading-->
                                <!--begin::Stats-->
                                <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                                    <!--SVG file not found: icons/duotune/arrows/Up-right.svg-->
                                    <!--begin::Number-->
                                    <div class="fw-bolder @if($item->status == 'مفعلة') text-success @else text-danger @endif me-2">{{$item->status}}</div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold text-gray-400">الحالة</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stats-->
                                <!--begin::Indicator-->
                                <div class="d-flex align-items-center fw-bold">
                                    <span class="badge bg-light text-gray-700 px-3 py-2 me-2">{{$item->end_date}}</span>
                                    <span class="text-gray-400 fs-7">تاريخ النهاية</span>
                                    {{-- <i class="fas fa-exclamation-circle fs-7 ms-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Recurring" aria-label="Recurring"></i> --}}
                                </div>

                                
                                <!--end::Indicator-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                </div>
            @endforeach
            {{$agreements_facility->links('vendor.pagination.bootstrap-4')}}
        </div>

        </div>
    @endsection