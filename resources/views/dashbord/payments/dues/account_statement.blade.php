@extends('dashbord.layouts.master')
@section('css')
@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('Toolbar.account_statement')}}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                        {{trans('Toolbar.home')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.Payment')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.account_statement')}}
                </li>


            </ul>

        </div>

    </div>

@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">

                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">

                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                            @if(!empty($all_data->talab_image) && file_exists(public_path('images/' . $all_data->talab_image)))
                                <img class="mw-50px mw-lg-75px" src="{{ asset('images/' . $all_data->talab_image) }}" alt="image" />
                            @else
                                <img class="mw-50px mw-lg-75px" src="" alt="" />
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
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{optional($all_data->test_data)->talab_title}}-{{$prefix.optional($all_data->test_data)->test_code}}</a>
                                       {!! $paid_status !!}
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">{{optional(optional($all_data->test_data)->company)->name .' -- '.optional(optional($all_data->test_data)->client)->name.' -- '.optional(optional($all_data->test_data)->project)->project_name.' -- '.optional($all_data->test_data)->test_type.' -- '.optional($all_data->test_data)->sub_test_type}}</div>
                                </div>

                                <div class="d-flex mb-4">

                                    <a href="#" class="btn btn-sm btn-primary me-3">{{trans('payment.add_pay')}}</a>



                                </div>

                            </div>

                            <div class="d-flex flex-wrap justify-content-start">

                                <div class="d-flex flex-wrap">

                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bold">{{optional($all_data->test_data)->talab_date}}</div>
                                        </div>

                                        <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.talab_date')}}</div>

                                    </div>

                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bold">{{optional($all_data->test_data)->wared_date}}</div>
                                        </div>

                                        <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.wared_date')}}</div>

                                    </div>



                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-arrow-up fs-3 text-success me-2"></i>
                                            <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_data->test_value}}" data-kt-countup-prefix="$">0</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.test_cost')}}</div>
                                    </div>

                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-arrow-up fs-3 text-success me-2"></i>
                                            <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_data->test_value-$all_data->required_value}}" data-kt-countup-prefix="$">0</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.paid_value')}}</div>
                                    </div>

                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3" style="">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-arrow-down fs-3 text-danger me-2"></i>
                                            <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$all_data->required_value}}" data-kt-countup-prefix="$">0</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-gray-500">{{trans('payment.remain')}}</div>
                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                    <div class="separator"></div>

                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">

                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6 active" href="{{route('admin.payment.account_statement',$all_data->id)}}">{{trans('payment.account_statement')}}</a>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="card card-flush mt-6 mt-xl-9">
                <!--begin::Card header-->
                <div class="card-header mt-5">
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">{{trans('payment.due_payment')}}</h3>
                        @php
                            $totalPayment = $all_data->client_test_payment->sum('value');
                        @endphp
                        <div class="fs-2 text-gray-500">
                             <span class="badge bg-light-success text-danger">Total :${{ number_format($totalPayment, 2) }}</span>
                        </div>

                    </div>

                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                            <thead class="fs-7 text-gray-500 text-uppercase">
                            <tr>
                                <th class="min-w-250px">{{trans('payment.invoice_number')}}</th>
                                <th class="min-w-150px">{{trans('payment.date')}}</th>
                                <th class="min-w-90px">{{trans('payment.amount')}}</th>
                                <th class="min-w-90px">{{trans('payment.receivable')}}</th>
                                <th class="min-w-90px">{{trans('payment.notes')}}</th>
                                <th class="min-w-90px">{{trans('payment.action')}}</th>

                            </tr>
                            </thead>
                            <tbody class="fs-6">
                            @foreach($all_data->client_test_payment as $pay)
                                <tr>
                                    <td>{{'INV-'.$pay->num}}</td>
                                    <td>{{$pay->paid_date}}</td>
                                    <td>{{$pay->value}}</td>
                                    <td> <div class="d-flex align-items-center">

                                            <div class="me-5 position-relative">
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="assets/media/avatars/300-6.jpg" />
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href="" class="fs-6 text-gray-800 text-hover-primary">Emma Smith</a>
                                                <div class="fw-semibold text-gray-500">smith@kpmg.com</div>
                                            </div>

                                        </div></td>
                                    <td>{{$pay->notes}}</td>
                                    <td>{{$pay->notes}}</td>
                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Card body-->
            </div>

        </div>

    </div>
@endsection


@section('js')

@endsection
