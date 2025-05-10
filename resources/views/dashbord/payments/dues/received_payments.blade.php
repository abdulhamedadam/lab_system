@extends('dashbord.layouts.master')
@section('toolbar')
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('receipt_voucher.create')}}</h1>
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
                    {{trans('Toolbar.received_payments')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{$type ?  trans('Toolbar.'.$type): trans('Toolbar.all')}}
                </li>


            </ul>

        </div>

    </div>

@endsection
@section('content')

    <!-- أزرار الفلترة -->
    <div class="d-flex justify-content-center mb-4">
        <div class="btn-group" role="group" id="filter-buttons">
            <a  href="{{route('admin.payment.received_payments',null)}}"  class="btn btn-secondary filter-btn @if($type == null) active @endif" data-filter="all">
                <i class="bi bi-list"></i> {{trans('payment.all')}}
            </a>
            <a href="{{route('admin.payment.received_payments','daily')}}" class="btn btn-secondary filter-btn @if($type == 'daily') active @endif" data-filter="daily">
                <i class="bi bi-calendar-day"></i> {{trans('payment.daily')}}
            </a>

            <a href="{{route('admin.payment.received_payments','weekly')}}" class="btn btn-secondary filter-btn @if($type == 'weekly') active @endif" data-filter="weekly">
                <i class="bi bi-calendar-day"></i> {{trans('payment.weekly')}}
            </a>
            <a  href="{{route('admin.payment.received_payments','monthly')}}" class="btn btn-secondary filter-btn @if($type == 'monthly') active @endif" data-filter="monthly">
                <i class="bi bi-calendar-month"></i> {{trans('payment.monthly')}}
            </a>
            <a  href="{{route('admin.payment.received_payments','yearly')}}"  class="btn btn-secondary filter-btn @if($type == 'yearly') active @endif" data-filter="yearly">
                <i class="bi bi-calendar"></i> {{trans('payment.yearly')}}
            </a>

        </div>
    </div>


    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card-body">
            <div class="col-md-12 row">
                <div class="col-md-3" style="margin: 10px 0px;">
                    <label for="client_id" class="form-label">{{ trans('reports.client_id') }}</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">{!! form_icon('select1') !!}</span>
                        <select class="form-select" name="client_id" id="client_id">
                            <option value="">{{ trans('reports.select') }}</option>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3" style="margin: 10px 0px;">
                    <label for="test_code" class="form-label">{{ trans('reports.test_code') }}</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">{!! form_icon('select1') !!}</span>
                        <input type="text" class="form-control" name="test_code" id="test_code"
                                placeholder="{{ trans('reports.test_code_placeholder') }}">
                    </div>
                </div>

                <div class="col-md-3" style="margin: 10px 0px;">
                    <label for="month" class="form-label">{{ trans('reports.month') }}</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">{!! form_icon('select1') !!}</span>
                        <select class="form-select" name="month" id="month">
                            <option value="">{{ trans('reports.select') }}</option>
                            @foreach($months as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table  class="table table-bordered"
                            id="table1">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th class="text-center">{{trans('payment.num')}}</th>
                            <th class="text-center">{{trans('payment.client')}}</th>
                            <th class="text-center w-200px">{{trans('payment.test')}}</th>
                            <th class="text-center w-200px">{{trans('payment.test_type')}}</th>
                            <th class="text-center">{{trans('payment.test_title')}}</th>
                            <th class="text-center w-300px" >{{trans('payment.value')}}</th>
                            <th class="text-center w-300px">{{trans('payment.paid_date')}}</th>
                            <th class="text-center w-300px">{{trans('payment.payment_type')}}</th>
                            <th class="text-center w-300px">{{trans('payment.notes')}}</th>
                            <th class="text-center w-300px">{{trans('payment.month')}}</th>
                            <th class="text-center w-300px">{{trans('payment.sader_date')}}</th>
                            <th class="text-center w-300px">{{trans('payment.sader_number')}}</th>
                            <th class="text-center">{{trans('payment.Action')}}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th colspan="5" class="text-center" style="background-color: lightslategrey">الإجمالي</th>
                            <th class="text-center" id="total-cost" style="background-color: lightcoral"></th>
                            <th colspan="4"></th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')

    <script>
        $(document).ready(function() {
            table = $('#table1').DataTable({
                "language": {
                    url: "{{ asset('assets/Arabic.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "{{ route('admin.payment.received_payments',$type) }}",
                    type: 'GET',
                    data: function (d) {
                        d.client_id = $('#client_id').val();
                        d.test_code = $('#test_code').val();
                        d.month = $('#month').val();
                    }
                },
                "columns": [
                    { data: 'num', className: 'text-center' },
                    { data: 'client', className: 'text-center no-export' },
                    { data: 'test', className: 'text-center' },
                    { data: 'test_type', className: 'text-center' },
                    { data: 'test_title', className: 'text-center' },
                    { data: 'value', className: 'text-center' },
                    { data: 'paid_date', className: 'text-center' },
                    { data: 'payment_type', className: 'text-center' },
                    { data: 'notes', className: 'text-center' },
                    { data: 'month', className: 'text-center' },
                    { data: 'sader_date', className: 'text-center' },
                    { data: 'sader_number', className: 'text-center' },
                    { data: 'action', orderable: false, className: 'text-center no-export' }
                ],
                "columnDefs": [
                    { "targets": [1, -1], "orderable": false }
                ],

                "order": [],
                "dom": '<"row align-items-center"<"col-md-3"l><"col-md-6"f><"col-md-3"B>>rt<"row align-items-center"<"col-md-6"i><"col-md-6"p>>',
                "buttons": [
                    {
                        "extend": 'excel',
                        "className": 'btn btn-sm btn-light ',
                        "text": '<i class="bi bi-file-earmark-excel"></i>',
                        "titleAttr": 'Excel'
                    },
                    {
                        "extend": 'print',
                        "className": 'btn btn-sm btn-light ',
                        "text": '<i class="bi bi-printer"></i>',
                        "titleAttr": 'Print'
                    },
                    {
                        "extend": 'colvis',
                        "className": 'btn btn-sm btn-light ',
                        "text": '<i class="bi bi-columns"></i>',
                        "titleAttr": 'Columns'
                    },
                    {
                        "text": '<i class="bi bi-arrow-repeat"></i>',
                        "className": 'btn btn-sm btn-light',
                        "titleAttr": 'Reload',
                        "action": function (e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    }
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    var totalCost = api.column(5, { page: 'current' }).data().reduce((a, b) => intVal(a) + intVal(b), 0);


                    $(api.column(5).footer()).html(totalCost.toFixed(2));

                }
            });
        });


    </script>

    <script>
        $('#client_id, #test_code, #month').on('change keyup', function() {
            table.ajax.reload();
        });

        function show_details(id) {

            blockUI.block();

            $.ajax({
                url: '{{route('admin.finance.Receipt_Voucher.index')}}',
                type: 'post',
                data: {
                    id: id,
                },
                success: function (data) {
                    $('#details').html(data);
                    blockUI.release();

                },
                error: function (xhr, status, error) {
                    blockUI.release();

                }
            });
        }

        function print_sand(id) {
            var request = $.ajax({
                url: "{{route('admin.finance.Receipt_Voucher.index')}}",
                type: "get",
                data: {id: id},
            });

            request.done(function (msg) {
                var WinPrint = window.open('', '', 'width=800,height=700,toolbar=0,scrollbars=0,status=0');

                // Write the HTML content to the new window
                WinPrint.document.write(msg);
                WinPrint.document.close(); // Ensure the content is fully loaded

                WinPrint.focus();

                // Trigger print after the content is fully loaded
                WinPrint.onload = function () {
                    WinPrint.print();
                    WinPrint.onafterprint = function () {
                        WinPrint.close();
                        console.log("Printing completed...");
                    };
                };
            });

            request.fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
        }

    </script>
@endsection
