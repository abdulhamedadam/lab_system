<div class="col-md-12">
    <div class="card" style="margin-right: 30px;margin-left: 30px; margin-top:-60px" >
        <div class="card-body" style="padding: 10px">
            <ul class="nav nav-pills nav-pills-custom mb-3">

                <li class="nav-item mb-3 me-3 me-lg-6">

                    <a href="{{route('admin.company_projects',$all_data->id)}}" style="background-color: powderblue;"
                       class="nav-link btn btn-outline btn-flex btn-color-muted
                     btn-active-color-danger flex-column overflow-hidden w-80px h-85px
                     pt-5 pb-2 {{ request()->routeIs('admin.company_projects') ? 'active' : '' }}" >
                        <div class="nav-icon mb-3">
                            <i class="fonticon-like-1 fs-1 p-0"></i>
                        </div>
                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{trans('company.projects')}}</span>
                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>

                    </a>

                </li>

            </ul>
        </div>
    </div>
</div>




<div class="col-md-12">
    <div class="card" style="margin-top: 5px;margin-bottom:10px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">
                <!-- Left column for the remaining buttons -->
                <div class="col-md-11">
                    <a href="{{route('admin.company_projects',$all_data->id)}}" class="btn btn-success p-2">
                        <i class="bi bi-file-earmark-text"></i> {{ trans('company.projects') }}
                    </a>

                    {{-- <a href="{{route('admin.company_dues',$all_data->id)}}" class="btn btn-info p-2"> --}}
                    <a href="" class="btn btn-info p-2">
                        <i class="bi bi-cash-stack"></i> {{ trans('company.money_track') }}
                    </a>
                </div>

                <div class="col-md-1 text-end">
                    <a class="btn btn-warning" href="{{ route('admin.test.index') }}">
                        <i class="bi bi-arrow-left-circle fs-3"></i>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>


