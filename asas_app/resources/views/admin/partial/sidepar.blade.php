<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
       <!--begin::Logo-->
       <a href="{{URL('/')}}">
       <img alt="Logo" src="{{asset('/assets/image/app/logo.png')}}" class="h-100px logo" />
       </a>
       <!--end::Logo-->
       <!--begin::Aside toggler-->

       <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
          <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
          <span class="svg-icon svg-icon-1 rotate-180">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
             </svg>
          </span>
          <!--end::Svg Icon-->
       </div>
       <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
       <!--begin::Aside Menu-->
       <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
          <!--begin::Menu-->
          <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
             <div class="menu-item">
                <div class="menu-content pb-2">
                   <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard </span>
                </div>
             </div>
             <div class="menu-item">
                <a class="menu-link active" href="{{URL('/')}}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">الرئيسية </span>
                </a>
             </div>

             <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                   <span class="menu-section text-muted text-uppercase fs-8 ls-1">USERS</span>
                </div>
             </div>

             {{-- start user management --}}
             @if(Auth()->user()->type == 'admin')
               <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                  <span class="menu-link">
                     <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                        <span class="svg-icon svg-icon-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                              <path d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z" fill="black"></path>
                           </svg>
                        </span>
                        <!--end::Svg Icon-->
                     </span>
                     <span class="menu-title">ادارة الحسابات</span>
                     <span class="menu-arrow"></span>
                  </span>
                  <div class="menu-sub menu-sub-accordion" kt-hidden-height="121" style="display: none; overflow: hidden;">

                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                           <span class="menu-bullet">
                              <span class="bullet bullet-dot"></span>
                           </span>
                           <span class="menu-title">مستخدمين</span>
                           <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                           <div class="menu-item">
                              <a class="menu-link" href="{{URL('/admin/fatherAdmin')}}">
                                 <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">اباء</span>
                              </a>
                           </div>
                           <div class="menu-item">
                              <a class="menu-link" href="{{URL('/admin/facilityAdmin')}}">
                                 <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">اصحاب مؤسسات</span>
                              </a>
                           </div>

                           {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                              <span class="menu-link">
                                 <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                                    <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Clothes/Crown.svg-->
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                           <polygon points="0 0 24 0 24 24 0 24"/>
                                           <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"/>
                                           <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"/>
                                       </g>
                                   </svg>
                                   <!--end::Svg Icon-->
                                 </span>
                                    <!--end::Svg Icon-->
                                 </span>
                                 <span class="menu-title">اصحاب مؤسسات</span>
                                 <span class="menu-arrow"></span>
                              </span>
                              <div class="menu-sub menu-sub-accordion" kt-hidden-height="121" style="display: none; overflow: hidden;">

                                 <div class="menu-item">
                                    <a class="menu-link" href="{{URL('/admin/facilityAdmin')}}">
                                       <span class="menu-bullet">
                                          <span class="bullet bullet-dot"></span>
                                       </span>
                                       <span class="menu-title">عرض</span>
                                    </a>
                                 </div>

                                 <div class="menu-item">
                                    <a class="menu-link" href="{{URL('/admin/facilityAdmin/create')}}">
                                       <span class="menu-bullet">
                                          <span class="bullet bullet-dot"></span>
                                       </span>
                                       <span class="menu-title"> اضافه</span>
                                    </a>
                                 </div>
                              </div>



                           </div> --}}
                        </div>
                     </div>

                  </div>
                  {{-- end user management --}}



               </div>




               <li class="menu-item" aria-haspopup="true">
                  <a href="{{URL('/admin/showAdmin')}}" class="menu-link">
                     <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                        <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                               <rect x="0" y="0" width="24" height="24"/>
                               <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                               <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                               <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                               <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                           </g>
                       </svg><!--end::Svg Icon--></span>
                        <!--end::Svg Icon-->
                     </span>
                     <span class="menu-text"> المشرفين</span>
                  </a>
               </li>


{{--
               <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                  <span class="menu-link">
                     <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                     </span>
                     <span class="menu-title">فريق الاداره</span>
                     <span class="menu-arrow"></span>
                  </span>
                  <div class="menu-sub menu-sub-accordion">
                     <div class="menu-item">
                        <a class="menu-link" href="{{URL('/admin/showAdmin')}}">
                           <span class="menu-bullet">
                              <span class="bullet bullet-dot"></span>
                           </span>
                           <span class="menu-title">عرض المشرفين</span>
                        </a>
                     </div>
                     <div class="menu-item">
                        <a class="menu-link" href="{{URL('register')}}">
                           <span class="menu-bullet">
                              <span class="bullet bullet-dot"></span>
                           </span>
                           <span class="menu-title">اضافة جديد</span>
                        </a>
                     </div>
                  </div>
               </div> --}}
             @endif

            {{-- end user management --}}

            {{-- setting --}}
            @if(Auth()->user()->type == 'admin')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->

                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Settings-2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">الاعدادات</span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion" kt-hidden-height="121" style="display: none; overflow: hidden;">
                  <div class="menu-item">
                     <a class="menu-link" href="{{URL('/admin/setting/CountryCity')}}">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">الدول و المدن</span>
                     </a>
                  </div>

                  <div class="menu-item">
                     <a class="menu-link" href="{{URL('/admin/setting/coins')}}">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">العملات</span>
                     </a>
                  </div>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/company_type')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <span class="svg-icon svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                              </g>
                          </svg></span>

                        </span>
                        <span class="menu-text">  انواع المؤسسات</span>
                     </a>
                  </li>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/programType')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                           <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Clipboard.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                  <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                  <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                  <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                              </g>
                          </svg><!--end::Svg Icon--></span>
                           <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text"> نوع البرنامج</span>
                     </a>
                  </li>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/timeTypes')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                           <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                                  <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                                  <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                                  <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                              </g>
                          </svg><!--end::Svg Icon--></span>
                           <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">انواع الدوام</span>
                     </a>
                  </li>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/curriculum_types')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                           <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Book-open.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
                                  <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
                              </g>
                          </svg><!--end::Svg Icon--></span>
                           <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">  انواع المناهج</span>
                     </a>
                  </li>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/reservation_status')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                           <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Cardboard-vr.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <polygon fill="#000000" opacity="0.3" points="6 4 18 4 20 6.5 4 6.5"/>
                                  <path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L20.999994,17.0000172 C20.999994,18.1045834 20.1045662,19.0000112 19,19.0000112 C17.4805018,19.0000037 16.4805051,19 16,19 C15,19 14.5,17 12,17 C9.5,17 9.5,19 8,19 C7.31386312,19 6.31387037,19.0000034 5.00002173,19.0000102 L5.00002173,19.0000216 C3.89544593,19.0000273 3.00000569,18.1045963 3,17.0000205 C3,17.000017 3,17.0000136 3,17.0000102 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M8,14 C9.1045695,14 10,13.1045695 10,12 C10,10.8954305 9.1045695,10 8,10 C6.8954305,10 6,10.8954305 6,12 C6,13.1045695 6.8954305,14 8,14 Z M16,14 C17.1045695,14 18,13.1045695 18,12 C18,10.8954305 17.1045695,10 16,10 C14.8954305,10 14,10.8954305 14,12 C14,13.1045695 14.8954305,14 16,14 Z" fill="#000000"/>
                              </g>
                          </svg><!--end::Svg Icon--></span>
                           <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text"> حالات الحجز</span>
                     </a>
                  </li>

                  <li class="menu-item" aria-haspopup="true">
                     <a href="{{URL('admin/beastFacilityYourCity')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                           <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Cardboard-vr.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <polygon fill="#000000" opacity="0.3" points="6 4 18 4 20 6.5 4 6.5"/>
                                  <path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L20.999994,17.0000172 C20.999994,18.1045834 20.1045662,19.0000112 19,19.0000112 C17.4805018,19.0000037 16.4805051,19 16,19 C15,19 14.5,17 12,17 C9.5,17 9.5,19 8,19 C7.31386312,19 6.31387037,19.0000034 5.00002173,19.0000102 L5.00002173,19.0000216 C3.89544593,19.0000273 3.00000569,18.1045963 3,17.0000205 C3,17.000017 3,17.0000136 3,17.0000102 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M8,14 C9.1045695,14 10,13.1045695 10,12 C10,10.8954305 9.1045695,10 8,10 C6.8954305,10 6,10.8954305 6,12 C6,13.1045695 6.8954305,14 8,14 Z M16,14 C17.1045695,14 18,13.1045695 18,12 C18,10.8954305 17.1045695,10 16,10 C14.8954305,10 14,10.8954305 14,12 C14,13.1045695 14.8954305,14 16,14 Z" fill="#000000"/>
                              </g>
                          </svg><!--end::Svg Icon--></span>
                           <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text"> افضل العروض في مدينتك</span>
                     </a>
                  </li>

                  {{-- <div class="menu-item">
                     <a class="menu-link" href="{{URL('/admin/import_data')}}">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">استيراد بيانات</span>
                     </a>
                  </div> --}}

               </div>






            </div>
            @endif
            {{-- الاتفاقيات --}}
            @if(Auth()->user()->type == 'admin')
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Clothes/Crown.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z" fill="#000000"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">الاتفاقيات</span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion" kt-hidden-height="121" style="display: none; overflow: hidden;">

                  <div class="menu-item">
                     <a class="menu-link" href="{{URL('/admin/agreement')}}">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">الاتفاقيات</span>
                     </a>
                  </div>

                  <div class="menu-item">
                     <a class="menu-link" href="{{URL('/admin/agreements_facility')}}">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title"> المؤسسات</span>
                     </a>
                  </div>
               </div>



            </div>
            @endif

            {{-- نهاء الاتفاقيات --}}

            <div class="menu-item">
               <div class="menu-content">
                  <div class="separator mx-1 my-4"></div>
               </div>
            </div>

              <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('/admin/facilityAdmin/top_pest_facility')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">  اكثر المؤسسات طلبا</span>
               </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('/admin/facilityAdmin/facility_program_page')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">   المؤسسات و البرامج</span>
               </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/facilityAdmin/reservations')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">  طلبات المستخدمين   </span>
               </a>
            </li>


            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/media')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> المعرض</span>
               </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/opinions')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> أراء</span>
               </a>
            </li>

            {{-- @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/timeTypes')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Watch2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,17 L15,17 L15,20.5 C15,21.3284271 14.3284271,22 13.5,22 L10.5,22 C9.67157288,22 9,21.3284271 9,20.5 L9,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z" fill="#000000" opacity="0.3"/>
                            <path d="M10.5,2 L13.5,2 C14.3284271,2 15,2.67157288 15,3.5 L15,7 L9,7 L9,3.5 C9,2.67157288 9.67157288,2 10.5,2 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,17 C14.7614237,17 17,14.7614237 17,12 C17,9.23857625 14.7614237,7 12,7 C9.23857625,7 7,9.23857625 7,12 C7,14.7614237 9.23857625,17 12,17 Z M12,19 C8.13400675,19 5,15.8659932 5,12 C5,8.13400675 8.13400675,5 12,5 C15.8659932,5 19,8.13400675 19,12 C19,15.8659932 15.8659932,19 12,19 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">انواع الدوام</span>
               </a>
            </li>
            @endif --}}

            {{-- @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/programType')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Clipboard.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> نوع البرنامج</span>
               </a>
            </li>
            @endif --}}
{{--
            @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/reservation_status')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Cardboard-vr.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="#000000" opacity="0.3" points="6 4 18 4 20 6.5 4 6.5"/>
                            <path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L20.999994,17.0000172 C20.999994,18.1045834 20.1045662,19.0000112 19,19.0000112 C17.4805018,19.0000037 16.4805051,19 16,19 C15,19 14.5,17 12,17 C9.5,17 9.5,19 8,19 C7.31386312,19 6.31387037,19.0000034 5.00002173,19.0000102 L5.00002173,19.0000216 C3.89544593,19.0000273 3.00000569,18.1045963 3,17.0000205 C3,17.000017 3,17.0000136 3,17.0000102 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M8,14 C9.1045695,14 10,13.1045695 10,12 C10,10.8954305 9.1045695,10 8,10 C6.8954305,10 6,10.8954305 6,12 C6,13.1045695 6.8954305,14 8,14 Z M16,14 C17.1045695,14 18,13.1045695 18,12 C18,10.8954305 17.1045695,10 16,10 C14.8954305,10 14,10.8954305 14,12 C14,13.1045695 14.8954305,14 16,14 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> حالات الحجز</span>
               </a>
            </li>
            @endif --}}

            {{-- @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/company_type')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <span class="svg-icon svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                        </g>
                    </svg></span>

                  </span>
                  <span class="menu-text">  انواع المؤسسات</span>
               </a>
            </li>
            @endif --}}
{{--
            @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/curriculum_types')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Book-open.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">  انواع المناهج</span>
               </a>
            </li>
            @endif --}}

            @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/notification/all')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Notifications1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> اشعارات</span>
               </a>
            </li>
            @endif

            @if(Auth()->user()->type == 'admin')
            <li class="menu-item" aria-haspopup="true">
               <a href="{{URL('admin/page/main/chat')}}" class="menu-link">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Notifications1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text"> محادثات</span>
               </a>
            </li>
            @endif





             <div class="menu-item">
                <div class="menu-content">
                   <div class="separator mx-1 my-4"></div>
                </div>
             </div>

             <li class="menu-item" aria-haspopup="true">
               <a href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                  <span class="svg-icon menu-icon">
                     <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                     <span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Notifications1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24"/>
                           <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                           <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                           <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                     </g>
                    </svg><!--end::Svg Icon--></span>
                     <!--end::Svg Icon-->
                  </span>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
                  <span class="menu-text"> تسجيل الخروج</span>
               </a>
            </li>



         </div>




          </div>
          <!--end::Menu-->
       </div>
       <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->

    <!--end::Footer-->
 </div>
