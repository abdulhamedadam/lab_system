<!--<div class="col-md-12">
    <div class="card" style="margin-right: 20px;margin-left: 20px;margin-top: 5px" >
        <div class="card-body" style="padding: 10px">



            <div class="row">
             
                <div class="col-md-11">
                    <a href="{{ route('admin.employee_files', $all_data->id) }}" class="btn btn-success p-2"> 
                        <i class="fas fa-file"></i> <?= trans('employees.employee_files') ?> 
                    </a>

                </div>

                <div class="col-md-1  text-end">
                    <a class="btn btn-warning" href="{{ route('admin.employee_data') }}">
                        <i class="bi bi-arrow-repeat fs-3"></i>{{trans('employees.back')}}
                    </a>
                </div>
            </div>

        </div>
    </div>
</div> -->
<div class="separator"></div>

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.employee_files', $all_data->id) ? 'active' : '' }}"
            href="{{ route('admin.employee_files', $all_data->id) }}">{{ trans('employees.employee_files') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 {{ request()->routeIs('admin.employee_salary', $all_data->id) ? 'active' : '' }}"
            href="{{ route('admin.employee_salary', $all_data->id) }}">{{ trans('employees.salary') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 "
            href="{{ route('admin.employee_files', $all_data->id) }}">{{ trans('common.loans') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 "
            href="{{ route('admin.employee_files', $all_data->id) }}">{{ trans('common.Deductions') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 "
            href="{{ route('admin.employee_files', $all_data->id) }}">{{ trans('common.Deductions') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-active-primary py-5 me-6 "
            href="}">{{ trans('common.Bonus') }}</a>
    </li>

    
</ul>
