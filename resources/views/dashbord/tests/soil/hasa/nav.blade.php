


<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.samples_test', $all_data->id) ? 'active' : '' }}"
           href="{{route('admin.samples_test',$all_data->id)}}">
            <i class="bi bi-vial me-2"></i> {{ trans('payment.tests') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.soil_test_dues', $all_data->id) ? 'active' : '' }}"
           href="{{route('admin.soil_test_dues',$all_data->id)}}">
            <i class="bi bi-cash-coin me-2"></i> {{ trans('tests.money_track') }}
        </a>
    </li>

</ul>



