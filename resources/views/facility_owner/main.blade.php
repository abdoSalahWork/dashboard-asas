@extends('facility_owner.layout.main')
@section('title', 'الرئيسية')
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
    </div>
	
			<!--begin::Post-->
			<div class="post d-flex flex-column-fluid" id="kt_post">
				<!--begin::Container-->
				<div id="kt_content_container" class="container-xxl">
					<!--begin::Navbar-->
					<div class="card mb-5 mb-xxl-8">
						<div class="card-body pt-9 pb-0">
							<!--begin::Details-->
							<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
								<!--begin: Pic-->
								<div class="me-7 mb-4">
									<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
										<img src="{{asset('assets/image/company')}}/{{$company_data->logo}}" alt="image" />
										<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
									</div>
								</div>
								<!--end::Pic-->
								<!--begin::Info-->
								<div class="flex-grow-1">
									<!--begin::Title-->
									<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
										<!--begin::User-->
										<div class="d-flex flex-column">
											<!--begin::Name-->
											<div class="d-flex align-items-center mb-2">
												<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{session('facility')->name_corporation}}</a>
												<a href="#">
													<!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
													<span class="svg-icon svg-icon-1 svg-icon-primary">
														<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
															<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
															<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</a>
											</div>
											<!--end::Name-->
											<!--begin::Info-->
											<div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
												<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
												<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
												<span class="svg-icon svg-icon-4 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
														<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->{{session('facility')->name}}</a>
												<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
												<!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
												<span class="svg-icon svg-icon-4 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
														<path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->{{$company_data->latitude}}, {{$company_data->longitude}}</a>
												<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
												<!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
												<span class="svg-icon svg-icon-4 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
														<path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->{{session('facility')->phone}}</a>
											</div>
											<!--end::Info-->
										</div>
										<!--end::User-->
										<!--begin::Actions-->
										<div class="d-flex my-4">
											<a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
												<span class="svg-icon svg-icon-3 d-none">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
														<path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--begin::Indicator-->
												{{-- <span class="indicator-label">Follow</span> --}}
												{{-- <span class="indicator-progress">Please wait... --}}
												{{-- <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> --}}
												<!--end::Indicator-->
											</a>
											{{-- <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_offer_a_deal">Hire Me</a> --}}
											<!--begin::Menu-->
											{{-- <div class="me-0">
												<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
													<i class="bi bi-three-dots fs-3"></i>
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
														<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
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
																		<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
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
											</div> --}}
											<!--end::Menu-->
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Title-->
									<!--begin::Stats-->
									<div class="d-flex flex-wrap flex-stack">
										<!--begin::Wrapper-->
										<div class="d-flex flex-column flex-grow-1 pe-8">
											<!--begin::Stats-->
											<div class="d-flex flex-wrap">
												<!--begin::Stat-->
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
													<!--begin::Number-->
													<div class="d-flex align-items-center">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														{{-- <span class="svg-icon svg-icon-3 svg-icon-success me-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
															</svg>
														</span> --}}
														<!--end::Svg Icon-->
														<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$programsCount}}" data-kt-countup-prefix="">0</div>
													</div>
													<!--end::Number-->
													<!--begin::Label-->
													<div class="fw-bold fs-6 text-gray-400">برامج</div>
													<!--end::Label-->
												</div>
												<!--end::Stat-->
												<!--begin::Stat-->
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
													<!--begin::Number-->
													<div class="d-flex align-items-center">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
														{{-- <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
																<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black" />
															</svg>
														</span> --}}
														<!--end::Svg Icon-->
														<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$countStudentsRequest_2}}">0</div>
													</div>
													<!--end::Number-->
													<!--begin::Label-->
													<div class="fw-bold fs-6 text-gray-400">الطلاب تم الموافقه عليهم</div>
													<!--end::Label-->
												</div>
												<!--end::Stat-->
												<!--begin::Stat-->
												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
													<!--begin::Number-->
													<div class="d-flex align-items-center">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														{{-- <span class="svg-icon svg-icon-3 svg-icon-success me-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
															</svg>
														</span> --}}
														<!--end::Svg Icon-->
														<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$countStudentsRequest_1}}" data-kt-countup-prefix="">0</div>
													</div>
													<!--end::Number-->
													<!--begin::Label-->
													<div class="fw-bold fs-6 text-gray-400">طلاب قيد الانتظار</div>
													<!--end::Label-->
												</div>


												<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
													<!--begin::Number-->
													<div class="d-flex align-items-center">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-3 svg-icon-success me-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
																<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
															  </svg>
														</span>
														<!--end::Svg Icon-->{{$company_rate[0]->rate_total}}
														<div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{$company_rate[0]->rate_total}}" data-kt-countup-prefix="5/">0</div>
													</div>
													<!--end::Number-->
													<!--begin::Label-->
													<div class="fw-bold fs-6 text-gray-400">تقيم المؤسسة  </div>
													<!--end::Label-->
												</div>
												<!--end::Stat-->
											</div>
											<!--end::Stats-->
										</div>
										<!--end::Wrapper-->
										<!--begin::Progress-->
										{{-- <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
											<div class="d-flex justify-content-between w-100 mt-auto mb-2">
												<span class="fw-bold fs-6 text-gray-400">Profile Compleation</span>
												<span class="fw-bolder fs-6">50%</span>
											</div>
											<div class="h-5px mx-3 w-100 bg-light mb-3">
												<div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div> --}}
										<!--end::Progress-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Info-->
							</div>
							<!--end::Details-->
							<!--begin::Navs-->

							<!--begin::Navs-->
						</div>
					</div>
					<!--end::Navbar-->
					<!--begin::Row-->
					<div class="row g-5 g-xxl-8">
						<!--begin::Col-->
						<div class="col-xl-6">
							<!--begin::Feeds Widget 1-->
							
							<!--end::Feeds Widget 1-->
							<!--begin::Feeds Widget 2-->
                            @foreach ($opinios as $item)
							<div class="card mb-5 mb-xxl-8">
								<!--begin::Body-->
								<div class="card-body pb-0">
									<!--begin::Header-->
									<div class="d-flex align-items-center mb-5">
										<!--begin::User-->
										<div class="d-flex align-items-center flex-grow-1">
											<!--begin::Avatar-->
											{{-- <div class="symbol symbol-45px me-5">
												<img src="" alt="" />
											</div> --}}
											<!--end::Avatar-->
											<!--begin::Info-->
											<div class="d-flex flex-column">
												<a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">{{$item->father_name}}</a>
												{{-- <span class="text-gray-400 fw-bold">PHP, SQLite, Artisan CLI</span> --}}
											</div>
											<!--end::Info-->
										</div>
										<!--end::User-->
										<!--begin::Menu-->
										<div class="my-0">
											<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
												<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
												<span class="svg-icon svg-icon-2">
                                                    رأي
													<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
															<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
														</g>
													</svg>
												</span>
												<!--end::Svg Icon-->
											</button>
											<!--begin::Menu 2-->
										
											<!--end::Menu 2-->
										</div>
										<!--end::Menu-->
									</div>
									<!--end::Header-->
									<!--begin::Post-->
									<div class="mb-5">
										<!--begin::Text-->
										<p class="text-gray-800 fw-normal mb-5">{{$item->opinion}}</p>
										<!--end::Text-->
										<!--begin::Toolbar-->
										<div class="d-flex align-items-center mb-5">
											{{-- <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
											<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
											<span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black" />
													<rect x="6" y="12" width="7" height="2" rx="1" fill="black" />
													<rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->120</a>
											<a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
											<!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->15</a> --}}
										</div>
										<!--end::Toolbar-->
									</div>
									<!--end::Post-->
									<!--begin::Separator-->
									<div class="separator mb-4"></div>
									<!--end::Separator-->
									<!--begin::Reply input-->
									{{-- <form class="position-relative mb-6">
										<textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1" placeholder="Reply.."></textarea>
										<div class="position-absolute top-0 end-0 me-n5">
											<span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
												<!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
												<span class="svg-icon svg-icon-3 mb-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z" fill="black" />
														<path d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</span>
											<span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
												<!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
												<span class="svg-icon svg-icon-2 mb-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
														<path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</span>
										</div>
									</form> --}}
									<!--edit::Reply input-->
								</div>
								<!--end::Body-->
							</div>
                                
                            @endforeach
							<!--end::Feeds Widget 2-->
							<!--begin::Feeds Widget 3-->
					
							<!--end::Feeds Widget 3-->
							<!--begin::Feeds Widget 4-->
							{{-- <button class="btn btn-primary w-100 text-center" id="kt_widget_5_load_more_btn">
								<span class="indicator-label">المزيد </span>
								<span class="indicator-progress">تحميل...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button> --}}

						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-xl-6">
							<!--begin::Charts Widget 1-->
						
							<!--end::Charts Widget 1-->
							<!--begin::List Widget 5-->
							<div class="card mb-5 mb-xxl-8">
								<!--begin::Header-->
								<div class="card-header align-items-center border-0 mt-4">
									<h3 class="card-title align-items-start flex-column">
										<span class="fw-bolder mb-2 text-dark">التقييم من 5</span>
										<span class="text-muted fw-bold fs-7">{{$company_rate[0]->count_rate}} عدد المقيمين</span>
									</h3>
									<div class="card-toolbar">
										<!--begin::Menu-->
										<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
														<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
														<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
														<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
													</g>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</button>
										<!--begin::Menu 1-->

										<!--end::Menu 1-->
										<!--end::Menu-->
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body pt-5">
									<!--begin::Timeline-->
									<div class="timeline-label">
										<!--begin::Item-->
										<div class="timeline-item">
											<!--begin::Label-->
											<div class="timeline-label fw-bolder text-gray-800 fs-6">{{$company_rate[0]->scientific_level}}</div>
											<!--end::Label-->
											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
														<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
													  </svg>
												</i>
											</div>
											<!--end::Badge-->
											<!--begin::Text-->
											<div class="timeline-content d-flex">
												<span class="fw-bolder text-gray-800 ps-3"> المستوى العلمي</span>
											</div>											<!--end::Text-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="timeline-item">
											<!--begin::Label-->
											<div class="timeline-label fw-bolder text-gray-800 fs-6">{{$company_rate[0]->activity_level}}</div>
											<!--end::Label-->
											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
														<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
													  </svg>
												</i>
											</div>
											<!--end::Badge-->
											<!--begin::Content-->
											<div class="timeline-content d-flex">
												<span class="fw-bolder text-gray-800 ps-3">مستوى الانشطة</span>
											</div>
											
											<!--end::Content-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="timeline-item">
											<!--begin::Label-->
											<div class="timeline-label fw-bolder text-gray-800 fs-6">{{$company_rate[0]->buildings_and_stadiums}}</div>
											<!--end::Label-->
											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
														<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
													  </svg>
												</i>
											</div>
											<!--end::Badge-->
											<!--begin::Desc-->
											<div class="timeline-content d-flex">
												<span class="fw-bolder text-gray-800 ps-3"> المباني و الملاعب</span>
											</div>
					
											<!--end::Desc-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="timeline-item">
											<!--begin::Label-->
											<div class="timeline-label fw-bolder text-gray-800 fs-6">{{$company_rate[0]->attention_and_communication}}</div>
											<!--end::Label-->
											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
														<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
													  </svg>
												</i>
											</div>
											<!--end::Badge-->
											<!--begin::Text-->
											<div class="timeline-content d-flex">
												<span class="fw-bolder text-gray-800 ps-3">الاهتمام و الاتصال </span>
											</div>
											<!--end::Text-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="timeline-item">
											<!--begin::Label-->
											<div class="timeline-label fw-bolder text-gray-800 fs-6">{{$company_rate[0]->discipline_and_cleanliness}}</div>
											<!--end::Label-->
											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16" style="color: orange;">
														<path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
													  </svg>
												</i>
											</div>
											<!--end::Badge-->
											<!--begin::Desc-->
											<div class="timeline-content d-flex">
												<span class="fw-bolder text-gray-800 ps-3"> الانضباط و النظافة</span>
											</div>
											<!--end::Desc-->
										</div>
										<!--end::Item-->
										<!--begin::Item-->

									</div>
									<!--end::Timeline-->
								</div>
								<!--end: Card Body-->
							</div>
							<!--end: List Widget 5-->
						</div>
						<!--end::Col-->
					</div> 
					<!--end::Row-->
					<!--begin::Modals-->
					<!--begin::Modal - Offer A Deal-->
					<div class="modal fade" id="kt_modal_offer_a_deal" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-1000px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header py-7 d-flex justify-content-between">
									<!--begin::Modal title-->
									<h2>Offer a Deal</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--begin::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y m-5">
									<!--begin::Stepper-->
									<div class="stepper stepper-links d-flex flex-column" id="kt_modal_offer_a_deal_stepper">
										<!--begin::Nav-->
										<div class="stepper-nav justify-content-center py-2">
											<!--begin::Step 1-->
											<div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
												<h3 class="stepper-title">Deal Type</h3>
											</div>
											<!--end::Step 1-->
											<!--begin::Step 2-->
											<div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
												<h3 class="stepper-title">Deal Details</h3>
											</div>
											<!--end::Step 2-->
											<!--begin::Step 3-->
											<div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
												<h3 class="stepper-title">Finance Settings</h3>
											</div>
											<!--end::Step 3-->
											<!--begin::Step 4-->
											<div class="stepper-item" data-kt-stepper-element="nav">
												<h3 class="stepper-title">Completed</h3>
											</div>
											<!--end::Step 4-->
										</div>
										<!--end::Nav-->
										<!--begin::Form-->
										<form class="mx-auto mw-500px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_modal_offer_a_deal_form">
											<!--begin::Type-->
											<div class="current" data-kt-stepper-element="content">
												<!--begin::Wrapper-->
												<div class="w-100">
													<!--begin::Heading-->
													<div class="mb-13">
														<!--begin::Title-->
														<h2 class="mb-3">Deal Type</h2>
														<!--end::Title-->
														<!--begin::Description-->
														<div class="text-muted fw-bold fs-5">If you need more info, please check out
														<a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
														<!--end::Description-->
													</div>
													<!--end::Heading-->
													<!--begin::Input group-->
													<div class="fv-row mb-15" data-kt-buttons="true">
														<!--begin::Option-->
														<label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 mb-6 active">
															<!--begin::Input-->
															<input class="btn-check" type="radio" checked="checked" name="offer_type" value="1" />
															<!--end::Input-->
															<!--begin::Label-->
															<span class="d-flex">
																<!--begin::Icon-->
																<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																<span class="svg-icon svg-icon-3hx">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
																		<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
																<!--end::Icon-->
																<!--begin::Info-->
																<span class="ms-4">
																	<span class="fs-3 fw-bolder text-gray-900 mb-2 d-block">Personal Deal</span>
																	<span class="fw-bold fs-4 text-muted">If you need more info, please check it out</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
														</label>
														<!--end::Option-->
														<!--begin::Option-->
														<label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6">
															<!--begin::Input-->
															<input class="btn-check" type="radio" name="offer_type" value="2" />
															<!--end::Input-->
															<!--begin::Label-->
															<span class="d-flex">
																<!--begin::Icon-->
																<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
																<span class="svg-icon svg-icon-3hx">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																			<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																			<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																			<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																</span>
																<!--end::Svg Icon-->
																<!--end::Icon-->
																<!--begin::Info-->
																<span class="ms-4">
																	<span class="fs-3 fw-bolder text-gray-900 mb-2 d-block">Corporate Deal</span>
																	<span class="fw-bold fs-4 text-muted">Create corporate account to manage users</span>
																</span>
																<!--end::Info-->
															</span>
															<!--end::Label-->
														</label>
														<!--end::Option-->
													</div>
													<!--end::Input group-->
													<!--begin::Actions-->
													<div class="d-flex justify-content-end">
														<button type="button" class="btn btn-lg btn-primary" data-kt-element="type-next">
															<span class="indicator-label">Offer Details</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Type-->
											<!--begin::Details-->
											<div data-kt-stepper-element="content">
												<!--begin::Wrapper-->
												<div class="w-100">
													<!--begin::Heading-->
													<div class="mb-13">
														<!--begin::Title-->
														<h2 class="mb-3">Deal Details</h2>
														<!--end::Title-->
														<!--begin::Description-->
														<div class="text-muted fw-bold fs-5">If you need more info, please check out
														<a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
														<!--end::Description-->
													</div>
													<!--end::Heading-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold mb-2">Customer</label>
														<!--end::Label-->
														<!--begin::Input-->
														<select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="details_customer">
															<option></option>
															<option value="1" selected="selected">Keenthemes</option>
															<option value="2">CRM App</option>
														</select>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold mb-2">Deal Title</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-solid" placeholder="Enter Deal Title" name="details_title" value="Marketing Campaign" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<!--begin::Label-->
														<label class="fs-6 fw-bold mb-2">Deal Description</label>
														<!--end::Label-->
														<!--begin::Label-->
														<textarea class="form-control form-control-solid" rows="3" placeholder="Enter Deal Description" name="details_description">Experience share market at your fingertips with TICK PRO stock investment mobile trading app</textarea>
														<!--end::Label-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<label class="required fs-6 fw-bold mb-2">Activation Date</label>
														<div class="position-relative d-flex align-items-center">
															<!--begin::Icon-->
															<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
															<span class="svg-icon svg-icon-2 position-absolute mx-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
																	<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
																	<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
																</svg>
															</span>
															<!--end::Svg Icon-->
															<!--end::Icon-->
															<!--begin::Datepicker-->
															<input class="form-control form-control-solid ps-12" placeholder="Pick date range" name="details_activation_date" />
															<!--end::Datepicker-->
														</div>
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-15">
														<!--begin::Wrapper-->
														<div class="d-flex flex-stack">
															<!--begin::Label-->
															<div class="me-5">
																<label class="required fs-6 fw-bold">Notifications</label>
																<div class="fs-7 fw-bold text-muted">Allow Notifications by Phone or Email</div>
															</div>
															<!--end::Label-->
															<!--begin::Checkboxes-->
															<div class="d-flex">
																<!--begin::Checkbox-->
																<label class="form-check form-check-custom form-check-solid me-10">
																	<!--begin::Input-->
																	<input class="form-check-input h-20px w-20px" type="checkbox" value="email" name="details_notifications[]" />
																	<!--end::Input-->
																	<!--begin::Label-->
																	<span class="form-check-label fw-bold">Email</span>
																	<!--end::Label-->
																</label>
																<!--end::Checkbox-->
																<!--begin::Checkbox-->
																<label class="form-check form-check-custom form-check-solid">
																	<!--begin::Input-->
																	<input class="form-check-input h-20px w-20px" type="checkbox" value="phone" checked="checked" name="details_notifications[]" />
																	<!--end::Input-->
																	<!--begin::Label-->
																	<span class="form-check-label fw-bold">Phone</span>
																	<!--end::Label-->
																</label>
																<!--end::Checkbox-->
															</div>
															<!--end::Checkboxes-->
														</div>
														<!--begin::Wrapper-->
													</div>
													<!--end::Input group-->
													<!--begin::Actions-->
													<div class="d-flex flex-stack">
														<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="details-previous">Deal Type</button>
														<button type="button" class="btn btn-lg btn-primary" data-kt-element="details-next">
															<span class="indicator-label">Financing</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Details-->
											<!--begin::Budget-->
											<div data-kt-stepper-element="content">
												<!--begin::Wrapper-->
												<div class="w-100">
													<!--begin::Heading-->
													<div class="mb-13">
														<!--begin::Title-->
														<h2 class="mb-3">Finance</h2>
														<!--end::Title-->
														<!--begin::Description-->
														<div class="text-muted fw-bold fs-5">If you need more info, please check out
														<a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
														<!--end::Description-->
													</div>
													<!--end::Heading-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<!--begin::Label-->
														<label class="d-flex align-items-center fs-6 fw-bold mb-2">
															<span class="required">Setup Budget</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="&lt;div class='p-4 rounded bg-light'&gt; &lt;div class='d-flex flex-stack text-muted mb-4'&gt; &lt;i class='fas fa-university fs-3 me-3'&gt;&lt;/i&gt; &lt;div class='fw-bold'&gt;INCBANK **** 1245 STATEMENT&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack fw-bold text-gray-600'&gt; &lt;div&gt;Amount&lt;/div&gt; &lt;div&gt;Transaction&lt;/div&gt; &lt;/div&gt; &lt;div class='separator separator-dashed my-2'&gt;&lt;/div&gt; &lt;div class='d-flex flex-stack text-dark fw-bolder mb-2'&gt; &lt;div&gt;USD345.00&lt;/div&gt; &lt;div&gt;KEENTHEMES*&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted mb-2'&gt; &lt;div&gt;USD75.00&lt;/div&gt; &lt;div&gt;Hosting fee&lt;/div&gt; &lt;/div&gt; &lt;div class='d-flex flex-stack text-muted'&gt; &lt;div&gt;USD3,950.00&lt;/div&gt; &lt;div&gt;Payrol&lt;/div&gt; &lt;/div&gt; &lt;/div&gt;"></i>
														</label>
														<!--end::Label-->
														<!--begin::Dialer-->
														<div class="position-relative w-lg-250px" id="kt_modal_finance_setup" data-kt-dialer="true" data-kt-dialer-min="50" data-kt-dialer-max="50000" data-kt-dialer-step="100" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
															<!--begin::Decrease control-->
															<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
																<!--begin::Svg Icon | path: icons/duotune/general/gen042.svg-->
																<span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</button>
															<!--end::Decrease control-->
															<!--begin::Input control-->
															<input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="finance_setup" readonly="readonly" value="$50" />
															<!--end::Input control-->
															<!--begin::Increase control-->
															<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
																<!--begin::Svg Icon | path: icons/duotune/general/gen041.svg-->
																<span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</button>
															<!--end::Increase control-->
														</div>
														<!--end::Dialer-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-8">
														<!--begin::Label-->
														<label class="fs-6 fw-bold mb-2">Budget Usage</label>
														<!--end::Label-->
														<!--begin::Row-->
														<div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
															<!--begin::Col-->
															<div class="col-md-6 col-lg-12 col-xxl-6">
																<!--begin::Option-->
																<label class="btn btn-outline btn-outline-dashed btn-outline-default active d-flex text-start p-6" data-kt-button="true">
																	<!--begin::Radio-->
																	<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																		<input class="form-check-input" type="radio" name="finance_usage" value="1" checked="checked" />
																	</span>
																	<!--end::Radio-->
																	<!--begin::Info-->
																	<span class="ms-5">
																		<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Precise Usage</span>
																		<span class="fw-bold fs-7 text-gray-600">Withdraw money to your bank account per transaction under $50,000 budget</span>
																	</span>
																	<!--end::Info-->
																</label>
																<!--end::Option-->
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-6 col-lg-12 col-xxl-6">
																<!--begin::Option-->
																<label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" data-kt-button="true">
																	<!--begin::Radio-->
																	<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
																		<input class="form-check-input" type="radio" name="finance_usage" value="2" />
																	</span>
																	<!--end::Radio-->
																	<!--begin::Info-->
																	<span class="ms-5">
																		<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Extreme Usage</span>
																		<span class="fw-bold fs-7 text-gray-600">Withdraw money to your bank account per transaction under $50,000 budget</span>
																	</span>
																	<!--end::Info-->
																</label>
																<!--end::Option-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Row-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row mb-15">
														<!--begin::Wrapper-->
														<div class="d-flex flex-stack">
															<!--begin::Label-->
															<div class="me-5">
																<label class="fs-6 fw-bold">Allow Changes in Budget</label>
																<div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
															</div>
															<!--end::Label-->
															<!--begin::Switch-->
															<label class="form-check form-switch form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" value="1" name="finance_allow" checked="checked" />
																<span class="form-check-label fw-bold text-muted">Allowed</span>
															</label>
															<!--end::Switch-->
														</div>
														<!--end::Wrapper-->
													</div>
													<!--end::Input group-->
													<!--begin::Actions-->
													<div class="d-flex flex-stack">
														<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="finance-previous">Project Settings</button>
														<button type="button" class="btn btn-lg btn-primary" data-kt-element="finance-next">
															<span class="indicator-label">Build Team</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Budget-->
											<!--begin::Complete-->
											<div data-kt-stepper-element="content">
												<!--begin::Wrapper-->
												<div class="w-100">
													<!--begin::Heading-->
													<div class="mb-13">
														<!--begin::Title-->
														<h2 class="mb-3">Deal Created!</h2>
														<!--end::Title-->
														<!--begin::Description-->
														<div class="text-muted fw-bold fs-5">If you need more info, please check out
														<a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
														<!--end::Description-->
													</div>
													<!--end::Heading-->
													<!--begin::Actions-->
													<div class="d-flex flex-center pb-20">
														<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="complete-start">Create New Deal</button>
														<a href="#" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" title="Coming Soon">View Deal</a>
													</div>
													<!--end::Actions-->
													<!--begin::Illustration-->
													<div class="text-center px-4">
														<img src="assets/media/illustrations/sketchy-1/20.png" alt="" class="w-100 mh-300px" />
													</div>
													<!--end::Illustration-->
												</div>
											</div>
											<!--end::Complete-->
										</form>
										<!--end::Form-->
									</div>
									<!--end::Stepper-->
								</div>
								<!--begin::Modal body-->
							</div>
						</div>
					</div>
					<!--end::Modal - Offer A Deal-->
					<!--end::Modals-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Post-->
        
@endsection
