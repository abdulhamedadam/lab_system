<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_projects', $all_data->id) ? 'active' : '' }}"
            href="{{ route('admin.company_projects', $all_data->id) }}">{{ trans('payment.projects') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_tests', $all_data->id) ? 'active' : '' }}"
           href="{{ route('admin.company_tests', $all_data->id) }}">{{ trans('payment.tests') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_dues', $all_data->id) ? 'active' : '' }}"
            href="{{ route('admin.company_dues', $all_data->id) }}">{{ trans('payment.all_dues') }}</a>
    </li>


    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_pay_dues', $all_data->id) ? 'active' : '' }}"
           href="{{ route('admin.company_pay_dues', $all_data->id) }}">{{ trans('payment.pay_dues') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.company_account_statement', $all_data->id) ? 'active' : '' }}"
           href="{{ route('admin.company_account_statement', $all_data->id) }}">{{ trans('payment.account_statement') }}</a>
    </li>
</ul>





