<div class="d-flex justify-content-center mb-4">
    <div class="btn-group" role="group" id="filter-buttons">
        <a href="{{ route('admin.Payments_received') }}" class="btn btn-secondary filter-btn {{ request()->routeIs('admin.Payments_received') ? 'active' : '' }}">
            <i class="bi bi-cash-coin"></i> {{ trans('payment.Payments_received') }}
        </a>
        <a href="{{ route('admin.unpaid_dues') }}" class="btn btn-secondary filter-btn {{ request()->routeIs('admin.unpaid_dues') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front"></i> {{ trans('payment.unpaid_dues') }}
        </a>
    </div>
</div>
