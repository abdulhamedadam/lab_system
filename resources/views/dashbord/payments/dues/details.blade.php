{{--<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= trans('dues.dues_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>

            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.client') ?></td>
                <td class="class_result">{{optional($all_data->client)->name}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test') ?></td>
                @php
                        $test_code=optional($all_data->test_data)->test_code;
                        $final_code=get_app_config_data('soil_prefix').$test_code;
                @endphp
                <td class="class_result">{{$final_code}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test_type') ?></td>
                <td class="class_result">{{$all_data->test_type}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test_title') ?></td>
                <td class="class_result">{{$all_data->test_name}}</td>
            </tr>
            <tr style="background-color: lightcoral">
                <td class="class_label" ><?= trans('dues.test_value') ?></td>
                <td class="class_result">{{$all_data->test_value}}</td>
            </tr>

            <tr style="background-color: lightgreen">
                <td class="class_label"><?= trans('dues.paid') ?></td>
                <td class="class_result" >{{$all_data->test_value - $required_value}}</td>
            </tr>

            <tr style="background-color: lightgoldenrodyellow">
                <td class="class_label"><?= trans('dues.remain') ?></td>
                <td class="class_result">{{ $required_value}}</td>
            </tr>


            <tr>
                <td class="class_label"><?= trans('dues.month') ?></td>
                <td class="class_result">{{$all_data->year}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.year') ?></td>
                <td class="class_result">{{\Carbon\Carbon::createFromFormat('m', $all_data->month)->format('F')}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.created_at') ?></td>
                <td class="class_result">{{\Carbon\Carbon::parse($all_data->created_at)->format('Y-m-d')}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.created_by') ?></td>
                <td class="class_result"></td>
            </tr>


            </tbody>
        </table>
    </div>
</div> --}}



<div class="d-flex flex-wrap flex-sm-nowrap mb-6">

    <div
        class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
        @if(!empty($all_data->talab_image) && file_exists(public_path('images/' . $all_data->talab_image)))
            <img class="mw-50px mw-lg-75px" src="{{ asset('images/' . $all_data->talab_image) }}"
                 alt="image"/>
        @else
            <img class="mw-50px mw-lg-75px" src="{{asset('images/test_default.jpg')}}" alt=""/>
        @endif
    </div>

    <div class="flex-grow-1">

        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

            <div class="d-flex flex-column">
                <div class="d-flex align-items-center mb-1">
                    @php
                        if($all_data->test_table == 'tbl_tests'){
                           $prefix=get_app_config_data('soil_prefix');
                         }else{
                           $prefix='';
                         }

                        if ($required_value == 0.0) {

                                 $paid_status = '<span class="badge badge-light-success me-auto">'.trans('payment.paid').'</span>';
                           } elseif ($required_value == $all_data->test_value) {
                                $paid_status = '<span class="badge badge-light-danger me-auto">'.trans('payment.unpaid').'</span>';
                           } else {
                                $paid_status = '<span class="badge badge-light-warning me-auto">'.trans('payment.partially_paid').'</span>';
                           }

                    @endphp
                    <a href="#"
                       class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{optional($all_data->test_data)->talab_title}}
                        -{{$prefix.optional($all_data->test_data)->test_code}}</a>
                    {!! $paid_status !!}
                </div>
                <div
                    class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">{{optional(optional($all_data->test_data)->company)->name .' -- '.optional(optional($all_data->test_data)->client)->name.' -- '.optional(optional($all_data->test_data)->project)->project_name.' -- '.optional($all_data->test_data)->test_type.' -- '.optional($all_data->test_data)->sub_test_type}}</div>
            </div>

            <div class="d-flex mb-4">

                <a href="{{route('admin.payment.pay_dues',$all_data->id)}}" class="btn btn-sm btn-primary me-3">{{trans('payment.add_pay')}}</a>


            </div>

        </div>

        <div class="d-flex flex-wrap justify-content-start">

            <div class="d-flex flex-wrap">

                <div
                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                    <div class="d-flex align-items-center">
                        <div
                            class="fs-4 fw-bold">{{optional($all_data->test_data)->talab_date}}</div>
                    </div>

                    <div
                        class="fw-semibold fs-6 text-gray-500">{{trans('payment.talab_date')}}</div>

                </div>

                <div
                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                    <div class="d-flex align-items-center">
                        <div
                            class="fs-4 fw-bold">{{optional($all_data->test_data)->wared_date}}</div>
                    </div>

                    <div
                        class="fw-semibold fs-6 text-gray-500">{{trans('payment.wared_date')}}</div>

                </div>


                <div
                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-arrow-up fs-3 text-success me-2"></i>
                        <div class="fs-4 fw-bold" data-kt-countup="true"
                             data-kt-countup-value="{{$all_data->test_value}}"
                             data-kt-countup-prefix="$">0
                        </div>
                    </div>
                    <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.test_cost')}}</div>
                </div>

                <div
                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-arrow-up fs-3 text-success me-2"></i>
                        <div class="fs-4 fw-bold" data-kt-countup="true"
                             data-kt-countup-value="{{$all_data->test_value-$required_value}}"
                             data-kt-countup-prefix="$">0
                        </div>
                    </div>
                    <div
                        class="fw-semibold fs-6 text-gray-500">{{trans('payment.paid_value')}}</div>
                </div>

                <div
                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                    style="">

                    <div class="d-flex align-items-center">
                        <i class="bi bi-arrow-down fs-3 text-danger me-2"></i>
                        <div class="fs-4 fw-bold" data-kt-countup="true"
                             data-kt-countup-value="{{$required_value}}"
                             data-kt-countup-prefix="$">0
                        </div>
                    </div>
                    <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.remain')}}</div>
                </div>

            </div>


        </div>

    </div>

</div>
