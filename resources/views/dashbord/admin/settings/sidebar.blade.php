<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="" style="padding-top: 20px;padding-right: 20px">
        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class=" nav-icon fa fa-cog fa-fw text-primary"></i>

                    <?= trans('settings.general_settings') ?>

                </h3>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <nav class="mt-2" style="background-color: #fff4f0 !important; border-radius: 5px;">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('admin.branches') }}" class="nav-link @if (Route::is('admin.branches')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.branches')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_branches()}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">
                                <li class="nav-item">
                                    <a href="{{ route('admin.governorates') }}" class="nav-link @if (Route::is('admin.governorates')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.governorates')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_areas()}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">


                                <li class="nav-item">
                                    <a href="{{ route('admin.areas') }}" class="nav-link @if (Route::is('admin.areas')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.areas')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_areas(1)}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{ route('admin.siteData') }}" class="nav-link @if (Route::is('admin.siteData')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.siteData')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">1</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{ route('admin.sarf_bands') }}" class="nav-link @if (Route::is('admin.sarf_bands')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.sarf_band')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">{{count_sarf_band()}}</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                                <li class="nav-item">
                                    <a href="{{ route('admin.app_config') }}" class="nav-link @if (Route::is('admin.app_config')) active @endif" style=" width: 100%;">
                            <span style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    {{trans('settings.app_config')}}
                                </span>
                                <span class="badge badge-danger" style="order: 1; margin-left: 5px;">0</span>
                            </span>
                                    </a>
                                </li>
                                <hr class="nav-separator">

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
