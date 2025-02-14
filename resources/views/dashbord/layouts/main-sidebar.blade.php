<?php use Illuminate\Support\Facades\Route;

?>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo"
                 src="{{ asset(!empty($mainData->image) ? $mainData->image : 'assets/media/logos/default-dark.svg') }}"
                 class="h-50px app-sidebar-logo-default"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                          fill="currentColor"/>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.dashboard']) ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-speedometer2 text-primary fs-5"></i>
        </span>
                        <span class="menu-title">{{ trans('sidebar.dashboard') }}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.branches', 'admin.siteData', 'admin.governorates', 'admin.areas']) ? 'active' : '' }}"
                       href="{{ route('admin.branches') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-sliders text-primary fs-5"></i> <!-- Changed to "sliders" -->
        </span>
                        <span class="menu-title">{{ trans('sidebar.general_settings') }}</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.employee_data', 'jobs', 'admin.archive_shelf_settings', 'shelf', 'admin.archive_settings', 'desk']) ? 'active' : '' }}"
                       href="{{ route('admin.employee_data') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-person-lines-fill text-success fs-5"></i> <!-- Changed to "person-lines-fill" -->
        </span>
                        <span class="menu-title">{{ trans('sidebar.employee_data') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.clients.index']) ? 'active' : '' }}"
                       href="{{ route('admin.clients.index') }}">
                               <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                     <i class="bi bi-people text-danger fs-5"></i>
                                </span>
                        <span class="menu-title">{{ trans('sidebar.clients') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.company.index']) ? 'active' : '' }}"
                       href="{{ route('admin.company.index') }}">
                               <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                     <i class="bi bi-building text-primary fs-5"></i>
                                </span>
                        <span class="menu-title">{{ trans('sidebar.companies') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.project.index']) ? 'active' : '' }}"
                       href="{{ route('admin.project.index') }}">
                               <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                        <i class="bi bi-diagram-3 text-success fs-5"></i>
                                </span>
                        <span class="menu-title">{{ trans('sidebar.projects') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.masrofat.index']) ? 'active' : '' }}"
                       href="{{ route('admin.masrofat.index') }}">
                               <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                    <i class="bi bi-cash-coin text-success fs-5"></i>
                                </span>
                        <span class="menu-title">{{ trans('sidebar.masrofat') }}</span>
                    </a>
                </div>


                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.all_tests']) ? 'active' : '' }}"
                       href="{{ route('admin.all_tests') }}">
                               <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                    <i class="bi bi-clipboard-data text-info fs-5"></i>
                                </span>
                        <span class="menu-title">{{ trans('sidebar.all_tests') }}</span>
                    </a>
                </div>

                {{--  <div class="menu-item">
                     <a class="menu-link {{ request()->routeIs(['admin.test.index']) ? 'active' : '' }}"
                        href="{{ route('admin.test.index') }}">
                                <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                     <i class="bi bi-clipboard-check text-success fs-5"></i>
                                 </span>
                         <span class="menu-title">{{ trans('sidebar.tests') }}</span>
                     </a>
                 </div>--}}

               <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                      {{ (in_array(optional(explode('.', Route::currentRouteName()))[1], array('test'))) ? 'show' : ''  }}
                     {{ (in_array(optional(explode('.', Route::currentRouteName()))[2], array('test'))) ? 'show' : ''  }}">
                    <span class="menu-link">
                      <span class="menu-icon">
                           <i class="bi bi-file-earmark-text fs-5"></i>
                      </span>
                    <span class="menu-title">{{ trans('sidebar.soil_tests') }}</span>
                    <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion
                          {{ (in_array(optional(explode('.', Route::currentRouteName()))[2], array('transportation','exercise_devices', 'task_management','schedule'))) ? 'show' : ''  }}
                         {{ (in_array(optional(explode('.', Route::currentRouteName()))[1], array('schedule'))) ? 'show' : ''  }}">

                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.test.index']) ? 'active' : '' }}" href="{{route('admin.test.index')}}">
                             <span class="menu-bullet">
                               <span class="bullet bullet-dot"></span>
                             </span>
                                <span class="menu-title">{{ trans('sidebar.soil_erosion_test') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php  if (optional(explode('.', Route::currentRouteName()))[2] == 'exercise_devices') {echo 'active';} ?>" href="">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                <span class="menu-title">{{ trans('sidebar.sand_cone_test') }}</span>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--end::sidebar menu-->

</div>
