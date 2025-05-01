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
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0"/>
                            </svg>
                        </span>
                        <span class="menu-title">{{ trans('sidebar.dashboard') }}</span>
                    </a>
                </div>
                @can('general_settings')
                    <hr class="w-100 border border-warning">
                    <div class="menu-item ">
                        <div class="menu-content">
                            <span class="fw-bold text-uppercase fs-7 text-warning">{{ trans('sidebar.settings_management') }}</span>
                        </div>
                    </div>

                    {{-- الإعدادات --}}
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.branches', 'admin.siteData', 'admin.governorates', 'admin.areas']) ? 'active' : '' }}"
                           href="{{ route('admin.branches') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.general_settings') }}</span>
                        </a>
                    </div>
                @endcan

                @can('user_mangement')
                    <hr class="w-100 border border-warning">
                    <div class="menu-item ">
                        <div class="menu-content">
                            <span class="fw-bold text-uppercase fs-7 text-warning">{{ trans('sidebar.user&employees_management') }}</span>
                        </div>
                    </div>

                    @can('employees')
                        {{-- الموظفين --}}
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.employee_data', 'jobs', 'admin.archive_shelf_settings', 'shelf', 'admin.archive_settings', 'desk']) ? 'active' : '' }}"
                               href="{{ route('admin.employee_data') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                    </svg>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.employee_data') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('users')
                        {{-- المستخدمين--}}
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.users.index']) ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.users') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('roles')
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.roles.index','admin.roles.create']) ? 'active' : '' }}"
                               href="{{ route('admin.roles.index') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.roles') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('permissions')
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.permissions.index','admin.permissions.create']) ? 'active' : '' }}"
                               href="{{ route('admin.permissions.index') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.5 11.5A3.5 3.5 0 0 1 7 8h2a3.5 3.5 0 1 1 0 7H7a3.5 3.5 0 0 1-3.5-3.5z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.permissions') }}</span>
                            </a>
                        </div>
                    @endcan

                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion {{ (in_array(optional(explode('.', Route::currentRouteName()))[2], array('loans','hr_deductions','hr_bonuses','hr_loan','hr_permission'))) ? 'show' : ''  }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{trans('sidebar.Employee_Operations')}}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion
                           {{ (in_array(optional(explode('.', Route::currentRouteName()))[2], array('hr_reports','hr_deductions','hr_bonuses','loans','hr_permission','reqholiday'))) ? 'show' : ''  }}">

                            @can('loans')
                                <div class="menu-item">
                                    <a class="menu-link @if(optional(explode('.', Route::currentRouteName()))[3] == 'loans')  active   @endif"
                                       href="{{ route('admin.loans.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ trans('sidebar.hr_loan') }}</span>
                                    </a>
                                </div>
                            @endcan

                            @can('bonuses')
                                <div class="menu-item">
                                    <a class="menu-link @if(optional(explode('.', Route::currentRouteName()))[3] == 'hr_bonuses')  active   @endif"
                                       href="{{ route('admin.bonuses.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ trans('sidebar.hr_bonuses') }}</span>
                                    </a>
                                </div>
                            @endcan

                            @can('deductions')
                                <div class="menu-item">
                                    <a class="menu-link @if(optional(explode('.', Route::currentRouteName()))[3] == 'deductions')  active   @endif"
                                       href="{{ route('admin.deductions.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ trans('sidebar.hr_deductions') }}</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    @can('payroll')
                        <div class="menu-item">
                            <a class="menu-link @if(optional(explode('.', Route::currentRouteName()))[1] == 'payroll')  active   @endif"
                               href="{{ route('admin.payroll.index') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11.666 1.89c.682-.925 1.334-2.012 1.334-3.89h-1c0 1.712-.803 2.757-1.334 3.89zM7.92 5.085c.072.162.155.373.247.627.099.265.214.588.336.958.244.74.467 1.764.556 2.956.1 1.355.127 2.725.046 3.974H4.93c-.08-1.249-.053-2.619.046-3.974.089-1.192.312-2.216.556-2.956.122-.37.237-.693.336-.958.092-.254.175-.465.247-.627A7.986 7.986 0 0 1 4.5 2h-1c0 1.878.652 2.965 1.334 3.89C5.803 6.757 6.5 7.712 6.5 9.5c0 .18 0 .362-.038.536.117.124.25.272.38.446.205.275.425.605.644.99.219.385.413.81.568 1.239.155.428.27.849.333 1.21.063.362.078.638.078.789h1.5c0-.151.015-.427.078-.789.063-.361.178-.782.333-1.21.155-.429.35-.854.568-1.239.219-.385.439-.715.644-.99.13-.174.263-.322.38-.446C10 9.862 10 9.68 10 9.5c0-1.788.697-2.743 1.166-3.61z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.payroll_report') }}</span>
                            </a>
                        </div>
                    @endcan
                @endcan

                <hr class="w-100 border border-warning">
                <div class="menu-item ">
                    <div class="menu-content">
                        <span class="fw-bold text-uppercase fs-7 text-warning">{{ trans('sidebar.projects&clients_management') }}</span>
                    </div>
                </div>

                {{-- الجهات المستفيده--}}
                @can('clients')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.clients.index']) ? 'active' : '' }}"
                           href="{{ route('admin.clients.index') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.clients') }}</span>
                        </a>
                    </div>
                @endcan

                {{-- الشركات--}}
                @can('companies')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.company.index']) ? 'active' : '' }}"
                           href="{{ route('admin.company.index') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.companies') }}</span>
                        </a>
                    </div>
                @endcan

                {{-- المشاريع--}}
                @can('projects')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.project.index']) ? 'active' : '' }}"
                           href="{{ route('admin.project.index') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z"/>
                                    <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.projects') }}</span>
                        </a>
                    </div>
                @endcan

                {{-- tests--}}
                @can('all_tests')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.all_tests']) ? 'active' : '' }}"
                           href="{{ route('admin.all_tests') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v13A1.5 1.5 0 0 0 1.5 16h13a1.5 1.5 0 0 0 1.5-1.5V3a1.5 1.5 0 0 0-.43-1.059A1.5 1.5 0 0 0 13 0H1.5zm7 1h5.5a.5.5 0 0 1 .5.5v5.5a.5.5 0 0 1-1 0V1.707L8.146 8.146a.5.5 0 0 1-.708-.708L14.293 1H8.5a.5.5 0 0 1 0-1z"/>
                                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.all_tests') }}</span>
                        </a>
                    </div>
                @endcan
                @can('external_tests')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.external_test.index']) ? 'active' : '' }}"
                           href="{{ route('admin.external_test.create') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg>
                            </span>
                            <span class="menu-title">{{ trans('sidebar.external_test') }}</span>
                        </a>
                    </div>
                @endcan
                @can('test_sader')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs(['admin.add_sader']) ? 'active' : '' }}"
                           href="{{ route('admin.add_sader') }}">
                        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                            <i class="bi bi-clipboard-data text-default fs-5"></i>
                        </span>
                            <span class="menu-title">{{ trans('sidebar.test_sader') }}</span>
                        </a>
                    </div>
                @endcan
                {{--  <div class="menu-item">
                     <a class="menu-link {{ request()->routeIs(['admin.test.index']) ? 'active' : '' }}"
                        href="{{ route('admin.test.index') }}">
                                <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                                     <i class="bi bi-clipboard-check text-warning fs-5"></i>
                                 </span>
                         <span class="menu-title">{{ trans('sidebar.tests') }}</span>
                     </a>
                 </div> --}}

                {{-- <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion
                      {{ in_array(optional(explode('.', Route::currentRouteName()))[1], ['test']) ? 'show' : '' }}
                     {{ in_array(optional(explode('.', Route::currentRouteName()))[2], ['test']) ? 'show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="bi bi-file-earmark-text fs-5"></i>
                        </span>
                        <span class="menu-title">{{ trans('sidebar.soil_tests') }}</span>
                        <span class="menu-arrow"></span>
                    </span>

                    <div
                        class="menu-sub menu-sub-accordion
                          {{ in_array(optional(explode('.', Route::currentRouteName()))[2], ['transportation', 'exercise_devices', 'task_management', 'schedule']) ? 'show' : '' }}
                         {{ in_array(optional(explode('.', Route::currentRouteName()))[1], ['schedule']) ? 'show' : '' }}">

                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs(['admin.test.index']) ? 'active' : '' }}"
                                href="{{ route('admin.test.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.soil_erosion_test') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php if (optional(explode('.', Route::currentRouteName()))[2] == 'exercise_devices') {
                                echo 'active';
                            } ?>" href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ trans('sidebar.sand_cone_test') }}</span>
                            </a>
                        </div>
                    </div>
                </div> --}}

                <hr class="w-100 border border-warning">
                <div class="menu-item ">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span
                            class=" fw-bold text-uppercase fs-7 text-warning">{{ trans('sidebar.finance_management') }}</span>
                    </div>
                    <!--end:Menu content-->
                </div>


                {{-- <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link   @if (in_array(optional(explode('.', Route::currentRouteName()))[2], ['accounts'])) {{ 'active' }} @endif"
                        href="{{ route('admin.finance.accounts.index') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                                    <path
                                        d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z" />
                                    <path
                                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9z" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ trans('sidebar.accounts') }}


                        </span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link   @if (in_array(optional(explode('.', Route::currentRouteName()))[2], ['Receipt_Voucher'])) {{ 'active' }} @endif"
                        href="{{ route('admin.finance.Receipt_Voucher.index') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ trans('sidebar.Receipt_Voucher') }}


                        </span>
                    </a>
                    <!--end:Menu link-->
                </div> --}}

            <!------------------------------------------------------------->

                @can('dues')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.dues.index') ? 'active' : '' }}"
                           href="{{ route('admin.payment.dues.index') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-credit-card text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.dues') }}</span>
                        </a>
                    </div>
                @endcan
                @can('received_payments')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.received_payments') ? 'active' : '' }}"
                           href="{{ route('admin.payment.received_payments') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-bank text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.received_payments') }}</span>
                        </a>
                    </div>
                @endcan
                @can('clients_account_statement')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.clients_account_statement') ? 'active' : '' }}"
                           href="{{ route('admin.payment.clients_account_statement') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-clipboard-data text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.clients_account_statement') }}</span>
                        </a>
                    </div>

                    {{-- Expenses --}}
                @endcan
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs(['admin.Payments_received', 'admin.unpaid_dues']) ? 'active' : '' }}"
                        href="{{ route('admin.Payments_received') }}">
                        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
                            <i class="bi bi-wallet2 text-default fs-5"></i>
                        </span>
                        <span class="menu-title">{{ trans('sidebar.companies_reports') }}</span>
                    </a>
                </div>
                @can('masrofat')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.masrofat.index') ? 'active' : '' }}"
                           href="{{ route('admin.masrofat.index') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-cash-coin text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.masrofat') }}</span>
                        </a>
                    </div>

                    {{-- Financial Reports --}}
                @endcan
                @can('financial_reports')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.financial_reports') ? 'active' : '' }}"
                           href="{{ route('admin.payment.financial_reports') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-file-earmark-bar-graph text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.financial_reports') }}</span>
                        </a>
                    </div>

                @endcan
                @can('expense_report')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.expense_report') ? 'active' : '' }}"
                           href="{{ route('admin.payment.expense_report') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-cash-stack text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.expense_report') }}</span>
                        </a>
                    </div>
                @endcan
                @can('revenue_report')
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.payment.revenue_report') ? 'active' : '' }}"
                           href="{{ route('admin.payment.revenue_report') }}">
        <span class="svg-icon svg-icon-2" style="margin-left: 5px">
            <i class="bi bi-graph-up text-default fs-5"></i>
        </span>
                            <span class="menu-title">{{ trans('sidebar.revenue_report') }}</span>
                        </a>
                    </div>
                @endcan

            </div>
        </div>
    </div>
    <!--end::sidebar menu-->

</div>



