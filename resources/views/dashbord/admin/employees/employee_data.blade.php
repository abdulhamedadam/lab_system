@extends('dashbord.layouts.master')
@section('css')
@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('employees.employees_data') }}</h3>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" href="{{ route('admin.add_employee') }}">
                            <i class="bi bi-plus fs-1"></i> {{ trans('employees.add_new_employee') }}
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive" >
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%">{{trans('employees.m')}}</th>
                                <th style="text-align: center">{{trans('employees.image')}}</th>
                                <th style="text-align: center"> {{trans('employees.name')}}</th>
                                <th style="text-align: center"> {{trans('employees.email')}}</th>
                                <th style="text-align: center"> {{trans('employees.address')}}</th>
                                <th style="text-align: center"> {{trans('employees.branch')}}</th>
                                <th style="text-align: center"> {{trans('employees.position')}}</th>
                                <th style="text-align: center"> {{trans('employees.governate')}}</th>
                                <th style="text-align: center"> {{trans('employees.area')}}</th>
                                <th style="width: 10%; text-align: center">{{trans('employees.actions')}}</th>

                            </tr>

                            </thead>
                            <tbody>

                        </table>
                    </div>
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
                    url: "{{ route('admin.get_ajax_employee') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'image', className: 'text-center' },
                    { data: 'name', className: 'text-center' },
                    { data: 'email', className: 'text-center' },
                    { data: 'address', className: 'text-center' },
                    { data: 'branch', className: 'text-center' },
                    { data: 'position', className: 'text-center' },
                    { data: 'governate', className: 'text-center' },
                    { data: 'area', className: 'text-center' },
                    { data: 'action', className: 'text-center' },
                ],
                "columnDefs": [
                    {
                        "targets": [ 1,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [1],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'color': '#6610f2',

                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [3,4,7,8],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [2,6],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'color': 'green',
                                'vertical-align': 'middle',
                            });
                        }
                    },

                    {
                        "targets": [5],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'color': 'red',
                                'vertical-align': 'middle',
                            });
                        }
                    },



                ],
                "order" : [],
                "dom": '<"row align-items-center"<"col-md-3"l><"col-md-6"f><"col-md-3"B>>rt<"row align-items-center"<"col-md-6"i><"col-md-6"p>>',
                "buttons": [
                    {
                        "extend": 'excel',
                        "text": '<i class="bi bi-file-earmark-excel"></i>إكسل',
                        "className": 'btn btn-dark'
                    },
                    {
                        "extend": 'copy',
                        "text": '<i class="bi bi-clipboard"></i>نسخ',
                        "className": 'btn btn-primary'
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
            });

            $("input").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        });
    </script>

    "use strict";
    <script type="text/javascript">
        var save_method;
        var table;
        var dt;

    </script>




    <script>


        "use strict";
        var KTDatatablesServerSide = function () {

            var initDatatable = function () {
                table = $("#table2").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [[1, 'desc']],
                    stateSave: true,
                    ajax: {
                        url: "{{ route('admin.get_ajax_employee') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'employee_name', className: 'text-center' },
                        { data: 'phone_number', className: 'text-center' },
                        { data: 'email', className: 'text-center' },
                        { data: 'address', className: 'text-center' },
                        { data: 'job_title', className: 'text-center' },
                        { data: 'national_id', className: 'text-center' },
                        { data: 'action', className: 'text-center' },

                    ],

                    columnDefs: [

                        {
                            "targets": [1],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': '#6610f2',
                                    'font-family':  'Arial',
                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [3,4,5,6,7],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [2],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': 'green',
                                    'vertical-align': 'middle',
                                });
                            }
                        },


                    ],

                });
            };

            return {
                init: function () {
                    initDatatable();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
    </script>









    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection