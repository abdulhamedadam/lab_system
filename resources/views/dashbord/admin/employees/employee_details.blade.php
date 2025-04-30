<!--<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= trans('employees.employee_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.profile_picture') ?></td>
                <td class="class_result">
                    <img src="{{ asset('images/'.$all_data->profile_picture) }}" alt="<?= trans('employees.profile_picture') ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                </td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.employee') ?></td>
                <td class="class_result">{{ $all_data->first_name.' '.$all_data->last_name  }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.employee_code') ?></td>
                <td class="class_result">{{ $all_data->emp_code }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.email') ?></td>
                <td class="class_result">{{ $all_data->email }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.national_id') ?></td>
                <td class="class_result">{{ $all_data->national_id }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.gender') ?></td>
                <td class="class_result">{{ trans('employees.'.$all_data->gender) }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.branch') ?></td>
                <td class="class_result">{{ $all_data->branch->name }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.position') ?></td>
                <td class="class_result">{{ $all_data->position }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.governate') ?></td>
                <td class="class_result">{{ $all_data->governate->title }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.area') ?></td>
                <td class="class_result">{{ $all_data->area->title }}</td>
            </tr>
            <tr >
                <td class="class_label"><?= trans('employees.hire_date') ?></td>
                <td class="class_result">{{ $all_data->hire_date }}</td>
            </tr>
            <tr >
                <td class="class_label"><?= trans('employees.phone') ?></td>
                <td class="class_result">{{ $all_data->phone }}</td>
            </tr>
            <tr >
                <td class="class_label"><?= trans('employees.whatsapp_num') ?></td>
                <td class="class_result">{{ $all_data->whatsapp_num }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.date_of_birth') ?></td>
                <td class="class_result">{{ $all_data->date_of_birth }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.address') ?></td>
                <td class="class_result">{{ $all_data->address }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.material_status') ?></td>
                <td class="class_result">{{ trans('employees.'.$all_data->material_status) }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.religion') ?></td>
                <td class="class_result">{{ trans('employees.'.$all_data->religion) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div> -->


<div class="d-flex flex-wrap flex-sm-nowrap  mb-6">
    

    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
            @if(!empty($all_data->profile_picture) && file_exists(public_path('images/' . $all_data->profile_picture)))
                <img  src="{{ asset('images/' . $all_data->profile_picture) }}" alt="image"/>
            @else
                <img  src="{{ asset('images/default_company_logo.png') }}" alt=""/>
            @endif
            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
        </div>
    </div>

    <div class="flex-grow-1">

        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

            <div class="d-flex flex-column">

                <div class="d-flex align-items-center mb-2">
                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $all_data->first_name.' '.$all_data->last_name  }}</a>
                    <a href="#">
                        <i class="bi bi-patch-check fs-1 text-primary"></i>
                    </a>

                </div>

                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-telephone fs-4 me-1"></i> {{$all_data->phone}}
                    </a>
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-geo-alt fs-4 me-1"></i> {{$all_data->employee_code}}
                    </a>
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                        <i class="bi bi-envelope fs-4 me-1"></i> {{$all_data->email}}
                    </a>
                </div>

                <!--end::Info-->
            </div>
            <!--end::User-->
            <!--begin::Actions-->
            <div class="d-flex my-4">
                <a href="{{route('admin.company.index')}}" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                    <i class="ki-duotone ki-check fs-3 d-none"></i>
                    <span class="indicator-label">{{ trans('company.back') }}</span>
                    <span class="indicator-progress">Please wait...
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>

                </a>


            </div>
            <!--end::Actions-->
        </div>
        <!--end::Title-->
        <!--begin::Stats-->
        <div class="d-flex flex-wrap flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <!--begin::Stats-->
                <div class="d-flex flex-wrap">
                    <!--begin::Stat-->


                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-arrow-down-circle fs-3 text-danger me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true">مهندس</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('common.job_title')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cash-coin fs-3 text-success me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" >10000</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('common.main_salary')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle fs-3 text-success me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true"  data-kt-countup-prefix="دينار ">0</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('common.Loan')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle fs-3 text-warning me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" >0</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('common.absence')}}</div>
                    </div>



                </div>

            </div>

        </div>

    </div>

</div>

