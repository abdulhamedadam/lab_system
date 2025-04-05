<div class="d-flex flex-wrap flex-sm-nowrap  mb-6">
    <!--begin: Pic-->

    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
{{--            @dd($all_data->image)--}}
{{--            @if(!empty($all_data->image) && file_exists(public_path('images/' . $all_data->image)))--}}
{{--                <img  src="{{ asset('images/' . $all_data->image) }}" alt="image"/>--}}
{{--            @else--}}
                <img  src="{{ asset('assets/images/company.jpg') }}" alt=""/>
{{--            @endif--}}
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
    <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
        <i class="bi bi-telephone fs-4 me-1"></i> {{$all_data->phone}}
    </span>
                    <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
        <i class="bi bi-geo-alt fs-4 me-1"></i> {{$all_data->address1}}
    </span>
                    <span class="d-flex align-items-center text-gray-500 mb-2">
        <i class="bi bi-envelope fs-4 me-1"></i> {{$all_data->email}}
    </span>
                </div>


                <!--end::Info-->
            </div>
            <!--end::User-->
            <!--begin::Actions-->
            <div class="d-flex my-4">
                <a href="{{route('admin.clients.index')}}" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
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
                            <i class="bi bi-buildings fs-3 text-primary me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$companies_data->count()}}">{{$companies_data->count()}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.companies')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-diagram-3 fs-3 text-success me-2"></i>
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$projects_data->count()}}" >{{$projects_data->count()}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('company.projects')}}</div>
                    </div>






                </div>

            </div>

        </div>

    </div>

</div>
