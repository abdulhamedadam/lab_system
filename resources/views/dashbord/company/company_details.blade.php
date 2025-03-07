
<!--
<div class="profile-card" style="margin-top: -20px">
    <div class="profile-header">
        <h2 class="profile-name">{{ $all_data->name }}</h2>
    </div>

    <div class="profile-stats">
        <div class="stat-item">
            <div class="stat-number">{{$projects_data->count()}}</div>
            <div class="stat-label"><?= trans('company.projects') ?></div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{$clients_data->count()}}</div>
            <div class="stat-label"><?= trans('company.clients') ?></div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{$tests_data->count()}}</div>
            <div class="stat-label"><?= trans('company.tests') ?></div>
        </div>
    </div>
    <table class="table table-bordered table-sm table-striped">
        <tbody>
        <tr>
            <td class="class_label" style="width: 25%"><?= trans('company.company_code') ?></td>
            <td class="class_result">{{ $all_data->company_code }}</td>
        </tr>
        <tr>
            <td class="class_label" style="width: 25%"><?= trans('company.name') ?></td>
            <td class="class_result">{{ $all_data->name  }}</td>
        </tr>
        <tr>
            <td class="class_label" style="width: 25%"><?= trans('company.email') ?></td>
            <td class="class_result">{{ $all_data->email  }}</td>
        </tr>
        <tr>
            <td class="class_label" style="width: 25%"><?= trans('company.phone') ?></td>
            <td class="class_result">{{ $all_data->phone }}</td>
        </tr>
        <tr>
            <td class="class_label" style="width: 25%"><?= trans('company.client') ?></td>
            <td class="class_result">{{ $all_data->client->name }}</td>
        </tr>
        </tbody>
    </table>
    <div class="social-links">
        <div class="social-icons">
            <a href="tel:{{$all_data->phone}}" class="social-icon" style="background-color: forestgreen">
                <i class="bi bi-phone"></i>
                <span class="tooltip">Call</span>
            </a>
            <a href="mailto:{{$all_data->email}}" class="social-icon"  style="background-color: lightcoral">
                <i class="bi bi-envelope"></i>
                <span class="tooltip">Email</span>
            </a>
            <a href="https://wa.me/{{$all_data->phone}}" class="social-icon" style="background-color: forestgreen">
                <i class="bi bi-whatsapp"></i>
                <span class="tooltip">WhatsApp</span>
            </a>
        </div>
    </div>
</div>-->


<div class="d-flex flex-wrap flex-sm-nowrap  mb-6">
    <!--begin: Pic-->

    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
            @if(!empty($all_data->talab_image) && file_exists(public_path('images/' . $all_data->talab_image)))
                <img  src="{{ asset('images/' . $all_data->talab_image) }}" alt="image"/>
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
                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$all_data->name}}</a>
                    <a href="#">
                        <i class="bi bi-patch-check fs-1 text-primary"></i>
                    </a>

                </div>

                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-telephone fs-4 me-1"></i> {{$all_data->phone}}
                    </a>
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-geo-alt fs-4 me-1"></i> {{$all_data->address1}}
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
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$tests_data->count()}}">{{$tests_data->count()}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.tests')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cash-coin fs-3 text-success me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_dues}}" data-kt-countup-prefix="$">{{$all_dues}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.dues')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle fs-3 text-success me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$paid_dues}}" data-kt-countup-prefix="$">{{$paid_dues}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.paid_dues')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle fs-3 text-warning me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_dues-$paid_dues}}" data-kt-countup-prefix="$">{{$all_dues-$paid_dues}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.remain_dues')}}</div>
                    </div>



                </div>

            </div>

        </div>

    </div>

</div>
