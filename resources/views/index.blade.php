@extends('admin.layout.main')
{{-- @extends('layouts.app') --}}
@section('title', 'الرئيسية')
@section('content')
<div class="card card-xxl-stretch container">
    <!--begin::Header-->
    <div class="card-header border-0 bg-danger py-5">
        <h3 class="card-title fw-bolder text-white">احصائيات</h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
            <!--begin::Menu 3-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                <!--begin::Heading-->
                <div class="menu-item px-3">
                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                </div>
                <!--end::Heading-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Create Invoice</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link flex-stack px-3">Create Payment
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a target name for future usage and reference" aria-label="Specify a target name for future usage and reference"></i></a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Generate Bill</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                    <a href="#" class="menu-link px-3">
                        <span class="menu-title">Subscription</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Plans</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Billing</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Statements</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content px-3">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications">
                                    <!--end::Input-->
                                    <!--end::Label-->
                                    <span class="form-check-label text-muted fs-6">Recuring</span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="#" class="menu-link px-3">Settings</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu 3-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body p-0" style="position: relative;">
        <!--begin::Chart-->
        <div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px; min-height: 200px;"><div id="apexchartshw036kmd" class="apexcharts-canvas apexchartshw036kmd apexcharts-theme-light" style="width: 1024px; height: 200px;"><svg id="SvgjsSvg1275" width="1024" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1277" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1276"><clipPath id="gridRectMaskhw036kmd"><rect id="SvgjsRect1280" width="1031" height="203" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskhw036kmd"></clipPath><clipPath id="nonForecastMaskhw036kmd"></clipPath><clipPath id="gridRectMarkerMaskhw036kmd"><rect id="SvgjsRect1281" width="1028" height="204" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter1287" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1288" flood-color="#cb1b46" flood-opacity="0.5" result="SvgjsFeFlood1288Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1289" in="SvgjsFeFlood1288Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1289Out"></feComposite><feOffset id="SvgjsFeOffset1290" dx="0" dy="5" result="SvgjsFeOffset1290Out" in="SvgjsFeComposite1289Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1291" stdDeviation="3 " result="SvgjsFeGaussianBlur1291Out" in="SvgjsFeOffset1290Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1292" result="SvgjsFeMerge1292Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1293" in="SvgjsFeGaussianBlur1291Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1294" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1295" in="SourceGraphic" in2="SvgjsFeMerge1292Out" mode="normal" result="SvgjsFeBlend1295Out"></feBlend></filter><filter id="SvgjsFilter1297" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1298" flood-color="#cb1b46" flood-opacity="0.5" result="SvgjsFeFlood1298Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1299" in="SvgjsFeFlood1298Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1299Out"></feComposite><feOffset id="SvgjsFeOffset1300" dx="0" dy="5" result="SvgjsFeOffset1300Out" in="SvgjsFeComposite1299Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1301" stdDeviation="3 " result="SvgjsFeGaussianBlur1301Out" in="SvgjsFeOffset1300Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1302" result="SvgjsFeMerge1302Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1303" in="SvgjsFeGaussianBlur1301Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1304" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1305" in="SourceGraphic" in2="SvgjsFeMerge1302Out" mode="normal" result="SvgjsFeBlend1305Out"></feBlend></filter></defs><g id="SvgjsG1306" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1307" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1316" class="apexcharts-grid"><g id="SvgjsG1317" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1319" x1="0" y1="0" x2="1024" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1320" x1="0" y1="20" x2="1024" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1321" x1="0" y1="40" x2="1024" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1322" x1="0" y1="60" x2="1024" y2="60" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1323" x1="0" y1="80" x2="1024" y2="80" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1324" x1="0" y1="100" x2="1024" y2="100" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1325" x1="0" y1="120" x2="1024" y2="120" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1326" x1="0" y1="140" x2="1024" y2="140" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1327" x1="0" y1="160" x2="1024" y2="160" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1328" x1="0" y1="180" x2="1024" y2="180" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1329" x1="0" y1="200" x2="1024" y2="200" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1318" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1331" x1="0" y1="200" x2="1024" y2="200" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1330" x1="0" y1="1" x2="0" y2="200" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1282" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1283" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1286" d="M 0 200L 0 125C 59.73333333333333 125 110.93333333333334 87.5 170.66666666666666 87.5C 230.39999999999998 87.5 281.59999999999997 120 341.3333333333333 120C 401.06666666666666 120 452.26666666666665 25 512 25C 571.7333333333333 25 622.9333333333333 100 682.6666666666666 100C 742.4 100 793.6 100 853.3333333333334 100C 913.0666666666667 100 964.2666666666667 100 1024 100C 1024 100 1024 100 1024 200M 1024 100z" fill="transparent" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskhw036kmd)" filter="url(#SvgjsFilter1287)" pathTo="M 0 200L 0 125C 59.73333333333333 125 110.93333333333334 87.5 170.66666666666666 87.5C 230.39999999999998 87.5 281.59999999999997 120 341.3333333333333 120C 401.06666666666666 120 452.26666666666665 25 512 25C 571.7333333333333 25 622.9333333333333 100 682.6666666666666 100C 742.4 100 793.6 100 853.3333333333334 100C 913.0666666666667 100 964.2666666666667 100 1024 100C 1024 100 1024 100 1024 200M 1024 100z" pathFrom="M -1 200L -1 200L 170.66666666666666 200L 341.3333333333333 200L 512 200L 682.6666666666666 200L 853.3333333333334 200L 1024 200"></path><path id="SvgjsPath1296" d="M 0 125C 59.73333333333333 125 110.93333333333334 87.5 170.66666666666666 87.5C 230.39999999999998 87.5 281.59999999999997 120 341.3333333333333 120C 401.06666666666666 120 452.26666666666665 25 512 25C 571.7333333333333 25 622.9333333333333 100 682.6666666666666 100C 742.4 100 793.6 100 853.3333333333334 100C 913.0666666666667 100 964.2666666666667 100 1024 100" fill="none" fill-opacity="1" stroke="#cb1b46" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskhw036kmd)" filter="url(#SvgjsFilter1297)" pathTo="M 0 125C 59.73333333333333 125 110.93333333333334 87.5 170.66666666666666 87.5C 230.39999999999998 87.5 281.59999999999997 120 341.3333333333333 120C 401.06666666666666 120 452.26666666666665 25 512 25C 571.7333333333333 25 622.9333333333333 100 682.6666666666666 100C 742.4 100 793.6 100 853.3333333333334 100C 913.0666666666667 100 964.2666666666667 100 1024 100" pathFrom="M -1 200L -1 200L 170.66666666666666 200L 341.3333333333333 200L 512 200L 682.6666666666666 200L 853.3333333333334 200L 1024 200"></path><g id="SvgjsG1284" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1337" r="0" cx="170.66666666666666" cy="87.5" class="apexcharts-marker w37wdkqcj no-pointer-events" stroke="#cb1b46" fill="#f1416c" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1285" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1332" x1="0" y1="0" x2="1024" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1333" x1="0" y1="0" x2="1024" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1334" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1335" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1336" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1315" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1278" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 100px;"></div><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 181.667px; top: 90.5px;"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;">Mar</div><div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: transparent; display: none;"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Net Profit: </span><span class="apexcharts-tooltip-text-y-value">$45 thousands</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
        <!--end::Chart-->
        <!--begin::Stats-->
        <div class="card-p mt-n20 position-relative">
            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                    {{-- <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"></rect>
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                        </svg>
                    </span> --}}

                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
                            <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                            <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>


                    <!--end::Svg Icon-->
                    <a href="#" class="text-warning fw-bold fs-6"> الدول {{$arr_count_cityCountry[0]}} </a>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    {{-- <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"></path>
                            <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"></path>
                        </svg>
                    </span> --}}

                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Box.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M4,7 L20,7 L20,19.5 C20,20.3284271 19.3284271,21 18.5,21 L5.5,21 C4.67157288,21 4,20.3284271 4,19.5 L4,7 Z M10,10 C9.44771525,10 9,10.4477153 9,11 C9,11.5522847 9.44771525,12 10,12 L14,12 C14.5522847,12 15,11.5522847 15,11 C15,10.4477153 14.5522847,10 14,10 L10,10 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="3" width="20" height="4" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-primary fw-bold fs-6">المدن {{$arr_count_cityCountry[1]}}</a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"></path>
                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-danger fw-bold fs-6 mt-2">مؤسسات {{$count_company}} </a>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col bg-light-success px-6 py-8 rounded-2">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                    {{-- <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black"></path>
                            <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black"></path>
                        </svg>
                    </span> --}}

                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Clothes/T-Shirt.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M7.83498136,4 C8.22876115,5.21244017 9.94385174,6.125 11.999966,6.125 C14.0560802,6.125 15.7711708,5.21244017 16.1649506,4 L17.2723671,4 C17.3446978,3.99203791 17.4181234,3.99191839 17.4913059,4 L17.5,4 C17.8012164,4 18.0713275,4.1331782 18.2546625,4.34386406 L22.5900048,6.8468751 C23.0682974,7.12301748 23.2321726,7.73460788 22.9560302,8.21290051 L21.2997802,11.0816097 C21.0236378,11.5599023 20.4120474,11.7237774 19.9337548,11.4476351 L18.5,10.6198563 L18.5,20 C18.5,20.5522847 18.0522847,21 17.5,21 L6.5,21 C5.94771525,21 5.5,20.5522847 5.5,20 L5.5,10.6204852 L4.0673344,11.4476351 C3.58904177,11.7237774 2.97745137,11.5599023 2.70130899,11.0816097 L1.04505899,8.21290051 C0.768916618,7.73460788 0.932791773,7.12301748 1.4110844,6.8468751 L5.74424153,4.34512566 C5.92759515,4.13371 6.19818276,4 6.5,4 L6.50978325,4 C6.58296578,3.99191839 6.65639143,3.99203791 6.72872211,4 L7.83498136,4 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-success fw-bold fs-6 mt-2">اباء {{$count_father}} </a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
        <div class="resize-triggers"><div class="expand-trigger">
            <div style="width: 1025px; height: 461px;"></div></div><div class="contract-trigger">
            </div>
        </div>
    </div>
    <!--end::Body-->
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-12">
            <canvas id="CountryAndFather"></canvas>
        </div>
        


            

    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>




    // chart Country And Father
    var countr = [];
    @foreach ($fatherCountry[0] as $country)
        countr.push("{{$country}}");
    @endforeach

    var count = [];
    @foreach ($fatherCountry[1] as $country)
        count.push("{{$country}}");
    @endforeach
  const labels = countr;

  const data = {
    labels: labels,
    datasets: [{
      label: 'الدول و الاباء',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: count,
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
  const myChart = new Chart(
    document.getElementById('CountryAndFather'),
    config,

  );
//   End Chart Country And fahter


//Start Chart Notification And Notofaocation Read



//End Chart Notification And Notofaocation Read





  
</script>
@endsection
