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

                    @include('dashbord.payments.dues.details')
                    @include('dashbord.payments.dues.nav')

                </div>
            </div>

            <div class="card card-flush mt-6 mt-xl-9">
                <!--begin::Card header-->
                <div class="card-header mt-5 d-flex justify-content-between align-items-center">
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">{{trans('payment.due_payment')}}</h3>
                        @php
                            $totalPayment = $all_data->client_test_payment->sum('value');
                        @endphp
                        <div class="fs-2 text-gray-500">
            <span class="badge bg-light-success text-danger">
                Total : ${{ number_format($totalPayment, 2) }}
            </span>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('admin.payment.print_account_statement',$all_data->id)}}">
                        <i class="bi bi-printer"></i> {{trans('payment.print_account_statement')}}
                    </a>
                </div>


                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="kt_profile_overview_table"
                               class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
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
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="me-5 position-relative">
                                                <div
                                                    class="symbol symbol-50px symbol-circle d-flex align-items-center justify-content-center bg-light">
                                                    <i class="bi bi-person-circle fs-2 text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href=""
                                                   class="fs-6 text-gray-800 text-hover-primary">{{optional($pay->receivable)->first_name.' '.optional($pay->receivable)->last_name}}</a>
                                                <div
                                                    class="fw-semibold text-gray-500">{{optional($pay->receivable)->email}}</div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>{{$pay->notes}}</td>
                                    <td>
                                        <a href="{{ route('admin.payment.print_invoice',$pay->id) }}"
                                           class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                                            <i class="bi bi-printer fs-2 me-1"></i>{{trans('payment.print')}}
                                        </a>
                                    </td>

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
