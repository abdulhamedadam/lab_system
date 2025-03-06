<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_projects',$all_data->id) ? 'active' : '' }}"
           href="{{route('admin.company_projects',$all_data->id)}}">{{trans('payment.projects')}}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_tests',$all_data->id) ? 'active' : '' }}"
           href="{{route('admin.company_tests',$all_data->id)}}">{{trans('payment.tests')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_dues',$all_data->id) ? 'active' : '' }}"
           href="{{route('admin.company_dues',$all_data->id)}}">{{trans('payment.pay_due')}}</a>
    </li>
</ul>




<!--<div class="col-md-12">
    <div class="card" style="margin-top: 5px;margin-bottom:10px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">

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
</div> -->


