<style>
    .separator {
    height: 1px;
    background-color: #e0e0e0;
    margin: 15px 0;
}

.company-nav-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 0 15px;
    margin-bottom: 20px;
}

.company-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 0;
    margin: 0;
    list-style: none;
}

.nav-item {
    margin: 0px 15px;
    position: relative;
    text-align: center;
}

.nav-link {
    display: block;
    padding: 15px 0;
    color: #555;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
    text-align: center;
}

.nav-link:hover {
    color: #2c3e50;
}

.nav-link.active {
    color: #3498db;
    border-bottom-color: #3498db;
}

.nav-link.active:after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #3498db;
    animation: navUnderline 0.3s ease-out;
}

@keyframes navUnderline {
    from {
        transform: scaleX(0);
    }
    to {
        transform: scaleX(1);
    }
}

@media (max-width: 768px) {
    .company-nav {
        flex-direction: column;
    }

    .nav-item {
        margin-right: 0;
        margin-bottom: 5px;
    }

    .nav-link {
        padding: 12px 15px;
        border-bottom: none;
        border-left: 3px solid transparent;
    }

    .nav-link.active {
        border-bottom: none;
        border-left-color: #3498db;
    }
}
</style>

<div class="separator"></div>

<div class="company-nav-container">
    <ul class="nav company-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.Payments_received') ? 'active' : '' }}"
                href="{{ route('admin.Payments_received') }}">{{ trans('payment.Payments_received') }}</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.company_tests', $all_data->id) ? 'active' : '' }}"
                href="{{ route('admin.company_tests', $all_data->id) }}">{{ trans('payment.tests') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.company_dues', $all_data->id) ? 'active' : '' }}"
                href="{{ route('admin.company_dues', $all_data->id) }}">{{ trans('payment.all_dues') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.company_pay_dues', $all_data->id) ? 'active' : '' }}"
                href="{{ route('admin.company_pay_dues', $all_data->id) }}">{{ trans('payment.pay_dues') }}</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.unpaid_dues') ? 'active' : '' }}"
                href="{{ route('admin.unpaid_dues') }}">{{ trans('payment.unpaid_dues') }}</a>
        </li>
    </ul>
</div>

