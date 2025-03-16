<!--<div class="col-md-12">
    <div class="card" style="margin-right: 30px;margin-left: 30px; margin-top:-60px" >
        <div class="card-body" style="padding: 10px">
            <ul class="nav nav-pills nav-pills-custom mb-3">

              {{--  <li class="nav-item mb-3 me-3 me-lg-6">

                    <a   style="background-color: snow;"
                         class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary
                    flex-column overflow-hidden w-80px h-85px pt-5 pb-2">

                        <div class="nav-icon mb-3">
                            <i class="fonticon-drive fs-1 p-0"></i>
                        </div>
                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('clients.profile')}}</span>

                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>

                    </a>

                </li>--}}


                <li class="nav-item mb-3 me-3 me-lg-6" st>

                    <a href="{{route('admin.client_companies',$all_data->id)}}" style="background-color: linen;"
                       class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-success
                       flex-column overflow-hidden w-80px h-85px pt-5 pb-2 {{ request()->routeIs('admin.client_companies') ? 'active' : '' }}">

                        <div class="nav-icon mb-3">
                            <i class="fonticon-bank fs-1 p-0"></i>
                        </div>

                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('clients.companies')}}</span>

                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>

                    </a>

                </li>

                <li class="nav-item mb-3 me-3 me-lg-6">

                    <a href="{{route('admin.client_projects',$all_data->id)}}" style="background-color: powderblue;"
                       class="nav-link btn btn-outline btn-flex btn-color-muted
                     btn-active-color-danger flex-column overflow-hidden w-80px h-85px
                     pt-5 pb-2 {{ request()->routeIs('admin.client_projects') ? 'active' : '' }}" >
                        <div class="nav-icon mb-3">
                            <i class="fonticon-like-1 fs-1 p-0"></i>
                        </div>
                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('clients.projects')}}</span>
                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>

                    </a>

                </li>

                <li class="nav-item mb-3 me-3 me-lg-6">
                    <a  style="background-color: lightpink;"
                        class="nav-link btn btn-outline btn-flex
                    btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2">
                        <div class="nav-icon mb-3">
                            <i class="fonticon-remote-control fs-1 p-0"></i>
                        </div>
                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('clients.test')}}</span>
                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    </a>
                </li>
{{--
                <li class="nav-item mb-3 me-3 me-lg-6">

                    <a  style="background-color: mintcream;"
                        class="nav-link btn btn-outline btn-flex btn-color-muted
                     btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2">

                        <div class="nav-icon mb-3">
                            <i class="fonticon-telegram fs-1 p-0"></i>
                        </div>

                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('clients.money')}}</span>

                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>

                    </a>

                </li> --}}

            </ul>
        </div>
    </div>
</div> -->


<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.client_companies', $all_data->id) ? 'active' : '' }}"
           href="{{ route('admin.client_companies', $all_data->id) }}">
            <i class="bi bi-buildings me-2"></i> {{ trans('clients.companies') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.client_projects', $all_data->id) ? 'active' : '' }}"
           href="{{ route('admin.client_projects', $all_data->id) }}">
            <i class="bi bi-diagram-3 me-2"></i> {{ trans('clients.projects') }}
        </a>
    </li>

</ul>

