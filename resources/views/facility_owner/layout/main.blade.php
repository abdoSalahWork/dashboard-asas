
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en" direction="rtl" dir="rtl" style="direction: rtl">
	<!--begin::Head-->
	<head><base href="">
		<title>@yield('title')</title>
		{{-- <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" /> --}}
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{asset('/assets/image/app/logo.png')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{asset('assets/css/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/css/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
      <style>
         /* .aside-enabled.aside-fixed .wrapper{
            padding-right: 265px !important;
         }
         .aside-fixed .aside{
            right: 0 !important;
         } */
      </style>
      @yield('style')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
           <!--begin::Page-->
           <div class="page d-flex flex-row flex-column-fluid">
              <!--begin::Aside sidepar-->
                @extends('facility_owner.partial.sidepar')
              <!--end::Aside sidepar-->
              <!--begin::Wrapper-->
              <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                 <!--begin::Header-->
                 <div class="d-flex align-items-center d-lg-none me-1" title="Show aside menu">
                  <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                     <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                     <span class="svg-icon svg-icon-2x mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                           <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </div>
               </div>
                {{-- @extends('admin.partial.header') --}}
                 <!--end::Header-->
                 <!--begin::Content-->
                 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
                 </div>
                 <!--end::Content-->
                 <!--begin::Footer-->
                 {{-- <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                       <!--begin::Copyright-->
                       <div class="text-dark order-2 order-md-1">
                          <span class="text-muted fw-bold me-1">2021©</span>
                          <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                       </div>
                       <!--end::Copyright-->
                       <!--begin::Menu-->
                       <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                          <li class="menu-item">
                             <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                          </li>
                          <li class="menu-item">
                             <a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
                          </li>
                          <li class="menu-item">
                             <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                          </li>
                       </ul>
                       <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                 </div> --}}
                 <!--end::Footer-->
              </div>
              <!--end::Wrapper-->
           </div>
           <!--end::Page-->
        </div>
        <!--end::Root-->
        <!--begin::Drawers-->


        <!--begin::Exolore drawer toggle-->
        {{-- <button id="kt_explore_toggle" class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0" title="Explore Metronic" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
        <span id="kt_explore_toggle_label">Explore</span>
        </button> --}}

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
           <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
           <span class="svg-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                 <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                 <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
              </svg>
           </span>
           <!--end::Svg Icon-->
        </div>
     
		<!--end::Scrolltop-->
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/javascript/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/javascript/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{asset('assets/javascript/fullcalendar.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets/javascript/widgets.js')}}"></script>
		<script src="{{asset('assets/javascript/chat.js')}}"></script>
		<script src="{{asset('assets/javascript/create-app.js')}}"></script>
		<script src="{{asset('assets/javascript/upgrade-plan.js')}}"></script>
		{{-- <script src="{{asset('assets/javascript/prismjs.bundle.js')}}"></script> --}}
		<script src="{{asset('assets/javascript/ckeditor-classic.bundle.js')}}"></script>
      
      @yield('scripts')
      
      
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>