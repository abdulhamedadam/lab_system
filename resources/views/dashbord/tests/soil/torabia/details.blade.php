


<div class="d-flex flex-wrap flex-sm-nowrap  mb-6">

    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
{{--            @if(!empty($all_data->talab_image) && file_exists(public_path('images/' . $all_data->talab_image)))--}}
{{--                <img  src="{{ asset('images/' . $all_data->talab_image) }}" alt="image"/>--}}
{{--            @else--}}
                <img  src="{{ asset('images/test_default.jpg') }}" alt=""/>
{{--            @endif--}}
            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
        </div>
    </div>

    <div class="flex-grow-1">

        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

            <div class="d-flex flex-column">

                <div class="d-flex align-items-center mb-2">
                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ get_app_config_data('soil_prefix').$all_data->test_code }}</a>
                    <a href="#">
                        <i class="bi bi-patch-check fs-1 text-primary"></i>
                    </a>

                </div>

                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-person fs-4 me-1"></i> {{optional($all_data->client)->name}}
                    </a>
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                        <i class="bi bi-building fs-4 me-1"></i> {{optional($all_data->company)->name}}
                    </a>
                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                        <i class="bi bi-folder fs-4 me-1"></i> {{optional($all_data->project)->project_name}}
                    </a>
                </div>

                <!--end::Info-->
            </div>

            <div class="d-flex my-4">
                <!-- Button to trigger the modal -->
                <a  data-bs-toggle="modal" data-bs-target="#statusModal">
                    <span class="badge bg-{{ $all_data->status == 'received' ? 'success' : 'danger' }}">{{ $all_data->status }}</span>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="statusSelect" class="form-label">Select Status</label>
                                    <select class="form-select" id="statusSelect" name="status">
                                        <option value="received" {{ $all_data->status == 'received' ? 'selected' : '' }}>received</option>
                                        <option value="pending" {{ $all_data->status == 'pending' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                            <i class="bi bi-file-earmark-text fs-3 text-primary me-2"></i> <!-- Changed to a document icon -->
                            <div class="fs-2 fw-bold" data-kt-countup="true" >{{$all_data->test_type}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('tests.test_type')}}</div>
                    </div>


                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-earmark-text fs-3 text-primary me-2"></i> <!-- Changed to a document icon -->
                            <div class="fs-2 fw-bold" data-kt-countup="true" >{{$all_data->talab_title}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('tests.talab_title')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-check fs-3 text-success me-2"></i> <!-- Changed to a calendar icon -->
                            <div class="fs-2 fw-bold" data-kt-countup="true" >{{$all_data->talab_date}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('tests.talab_date')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-x fs-3 text-danger me-2"></i> <!-- Changed to a calendar-x icon -->
                            <div class="fs-2 fw-bold" data-kt-countup="true" >{{$all_data->talab_end_date}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('tests.talab_end_date')}}</div>
                    </div>

                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-hash fs-3 text-info me-2"></i> <!-- Changed to a hash icon -->
                            <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_data->sample_number}}">{{$all_data->sample_number}}</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500">{{trans('tests.sample_number')}}</div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
