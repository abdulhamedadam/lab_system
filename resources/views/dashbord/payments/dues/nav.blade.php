<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.payment.account_statement',$all_data->id) ? 'active' : '' }}"
           href="{{route('admin.payment.account_statement',$all_data->id)}}">{{trans('payment.account_statement')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.payment.pay_dues',$all_data->id) ? 'active' : '' }}"
           href="{{route('admin.payment.pay_dues',$all_data->id)}}">{{trans('payment.pay_due')}}</a>
    </li>
</ul>
