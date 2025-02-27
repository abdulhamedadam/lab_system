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
                    {{trans('Toolbar.finance')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.Receipt_Voucher')}}
                </li>


            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="d-flex">
                <a href="{{route('admin.finance.Receipt_Voucher.create')}}"
                   class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                              rx="1" transform="rotate(-90 11.364 20.364)"
                                                              fill="currentColor"/>
														<rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                              fill="currentColor"/>
													</svg>
												</span>
                    <!--end::Svg Icon-->
                </a>
            </div>
            <!--end::Filter menu-->
            <!--begin::Secondary button-->
            <!--end::Secondary button-->
            <!--begin::Primary button-->
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
@endsection
@section('content')

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table  class="table table-bordered"
                           id="table1">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th class="text-center">{{trans('receipt_voucher.num')}}</th>
                            <th class="text-center">{{trans('receipt_voucher.date_at')}}</th>
                            <th class="text-center w-200px">{{trans('receipt_voucher.from_account')}}</th>
                            <th class="text-center w-200px">{{trans('receipt_voucher.to_account')}}</th>
                            <th class="text-center">{{trans('receipt_voucher.amount')}}</th>
                            <th class="text-center w-300px">{{trans('receipt_voucher.notes')}}</th>
                            <th class="text-center">{{trans('receipt_voucher.Action')}}</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="kt_block_ui">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('members.details')}}</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="details">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{trans('sub.Close')}}</button>

                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')

    <script>
        $(document).ready(function() {
            //datatables
            table = $('#table1').DataTable({
                "language": {
                    url: "{{ asset('assets/Arabic.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "{{ route('admin.finance.Receipt_Voucher.index')}}",
                    type: 'GET'
                },
                "columns": [

                    {
                        data: 'num',
                        className: 'text-center'
                    },
                    {
                        data: 'date_at',
                        className: 'text-center no-export'
                    },
                    {
                        data: 'from_account',
                        className: 'text-center'
                    },
                    {
                        data: 'to_account',
                        className: 'text-center'
                    },
                    {
                        data: 'amount',
                        className: 'text-center'
                    },
                    {
                        data: 'notes',
                        className: 'text-center'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        className: 'text-center no-export'
                    },
                ],
                "columnDefs": [{
                    "targets": [1, -1], //last column
                    "orderable": false, //set not orderable
                },
                    {
                        "targets": [1],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'color': '#6610f2',

                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [3],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [2],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'color': 'green',
                                'vertical-align': 'middle',
                            });
                        }
                    },








                ],
                "order": [],
                "dom": '<"row align-items-center"<"col-md-3"l><"col-md-6"f><"col-md-3"B>>rt<"row align-items-center"<"col-md-6"i><"col-md-6"p>>',
                "buttons": [{
                    "extend": 'excel',
                    ////  "text": '<i class="bi bi-file-earmark-excel"></i>إكسل',
                    // "className": 'btn btn-dark'
                },
                    {
                        "extend": 'copy',
                        //  "text": '<i class="bi bi-clipboard"></i>نسخ',
                        //   "className": 'btn btn-primary'
                    },
                    {
                        "extend": 'print',
                        //  "text": '<i class="bi bi-clipboard"></i>نسخ',
                        //   "className": 'btn btn-primary'
                    }
                ],

                "language": {
                    "lengthMenu": "عرض _MENU_ سجلات",
                    "zeroRecords": "لا توجد سجلات",
                    "info": "عرض الصفحة _PAGE_ من _PAGES_",
                    "infoEmpty": "لا توجد سجلات",
                    "infoFiltered": "(مرشح من _MAX_ إجمالي السجلات)",
                    "search": "بحث:",
                    "paginate": {
                        "first": "الأول",
                        "last": "الأخير",
                        "next": "التالي",
                        "previous": "السابق"
                    }
                },
                "lengthMenu": [
                    [10, 5, 25, 50, -1],
                    [10, 5, 25, 50, "الكل"]
                ],
            });

            $("input").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        });
    </script>

    <script>
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
