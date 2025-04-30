@extends('dashbord.layouts.master')
@section('css')


@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{ trans('Toolbar.account_statement') }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                        {{ trans('Toolbar.home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ trans('Toolbar.Payment') }}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ trans('Toolbar.account_statement') }}
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

                    @include('dashbord.company.company_details')
                    @include('dashbord.company.company_nav')

                </div>
            </div>

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-12">
                    <div class="card card-flush  h-md-100">
                        <div class="card-header mt-5 d-flex justify-content-between align-items-center">
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">{{ trans('dues.all_dues') }}</h3>
                            </div>

                        </div>


                        <div class="card-body pt-0" style="padding: 10px">
                            <div class="table-responsive">
                                <table id="kt_profile_overview_table" class="table table-bordered">
                                    <thead class="fs-7 text-gray-500 text-uppercase">
                                    <tr>
                                        <th>{{ trans('tests.test_code') }}</th>
                                        <th>{{ trans('tests.test_name') }}</th>
                                        <th>{{ trans('tests.sample_number') }}</th>
                                        <th>{{ trans('tests.sample_cost') }}</th>
                                        <th>{{ trans('tests.test_value') }}</th>
                                        <th>{{ trans('tests.wared_number') }}</th>
                                        <th>{{ trans('tests.wared_date') }}</th>

                                        <th>{{ trans('tests.sader_num') }}</th>
                                        <th>{{ trans('tests.sader_date') }}</th>
                                        <th>{{ trans('tests.paid') }}</th>
                                        <th>{{ trans('tests.remain') }}</th>

                                    </tr>
                                    </thead>
                                    <tbody class="fs-6">
                                    @foreach ($dues_data as $record)
                                        <!-- Due row with background color and clickable -->
                                        <tr class="bg-light-primary cursor-pointer" data-bs-toggle="collapse" data-bs-target="#paymentDetails{{ $record->id }}" aria-expanded="true" aria-controls="paymentDetails{{ $record->id }}">
                                            <td>{{  optional($record->test_data)->test_code_st }}</td>
                                            <td>{{ $record->test_name }}</td>
                                            <td>{{ optional($record->test_data)->sample_number }}</td>
                                            <td>{{ optional($record->test_data)->sample_cost }}</td>
                                            <td>{{ $record->test_value }}</td>
                                            <td>{{ optional($record->test_data)->wared_number }}</td>
                                            <td>{{ optional($record->test_data)->wared_date }}</td>
                                            <td>{{ optional(optional($record->test_data)->sader)->num }}</td>
                                            <td>{{ optional(optional($record->test_data)->sader)->date }}</td>
                                            <td>{{ $record->client_test_payment->sum('value') }}</td>
                                            <td>{{$record->test_value - $record->client_test_payment->sum('value') }}</td>

                                        </tr>


                                        <tr>
                                            <td colspan="12" class="p-0">
                                                <div class="collapse" id="paymentDetails{{ $record->id }}">
                                                    <div class="card card-body m-2 border-0">
                                                        @if(isset($record->client_test_payment) && count($record->client_test_payment) > 0)
                                                            <table class="table table-bordered  align-middle">
                                                                <thead class="table-light fs-7 ">
                                                                <tr>
                                                                    <th>{{ trans('payments.num') }}</th>
                                                                    <th>{{ trans('payments.value') }}</th>
                                                                    <th>{{ trans('payments.paid_date') }}</th>
                                                                    <th>{{ trans('payments.payment_type') }}</th>
                                                                    <th>{{ trans('payments.notes') }}</th>
                                                                    <th>{{ trans('payments.action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($record->client_test_payment as $payment)
                                                                    <tr>
                                                                        <td>{{'INV'. $payment->num }}</td>
                                                                        <td>{{ $payment->value }}</td>
                                                                        <td>{{ $payment->paid_date }}</td>
                                                                        <td>{{ $payment->payment_type }}</td>
                                                                        <td>{{ $payment->notes }}</td>
                                                                        <td>
                                                                            <a href="{{ route('admin.payment.print_invoice',$payment->id) }}"
                                                                               class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                                                                                <i class="bi bi-printer fs-2 me-1"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <div class="alert alert-warning d-flex align-items-center p-3">
                                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                                <div>
                                                                    {{ trans('payments.no_payments_found') }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr class="border-0">
                                            <td colspan="5" class="p-1"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>

                </div>

            </div>


        </div>

    </div>
@endsection


@section('js')
    <script>
        function show_due_details(id) {
            var url = "{{ route('admin.company_due_details', ['id' => $all_data->id, 'due_id' => '__due_id__']) }}"
                .replace('__due_id__', id);
            $.ajax({
                url: "{{ route('admin.company_due_details', ['id' => $all_data->id, 'due_id' => '__due_id__']) }}"
                    .replace('__due_id__', id),
                type: "get",
                dataType: "html",
                success: function(html) {
                    $('#due_deatails').html(html);
                },
                error: function(xhr, status, error) {
                    console.log(url);
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const collapsibleRows = document.querySelectorAll('[data-bs-toggle="collapse"]');

            collapsibleRows.forEach(row => {
                row.addEventListener('click', function() {
                });
            });
        });
    </script>

    <script>
        function printInvoice(invoiceId) {
            let url = `<?php echo e(route('admin.payment.print_invoice', ['id' => '__ID__'])); ?>`.replace('__ID__', invoiceId);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(html) {
                    const printFrame = document.getElementById(`print-frame-${invoiceId}`);
                    printFrame.srcdoc = html;

                    printFrame.onload = function() {
                        printFrame.contentWindow.print();
                    };
                },
                error: function() {
                    console.error('Error fetching invoice.');
                    alert('Error printing invoice. Please try again.');
                }
            });
        }
    </script>
@endsection
