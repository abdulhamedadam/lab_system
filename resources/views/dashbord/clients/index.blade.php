@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('client.clients');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.clients.create')],
                  ['label' => trans('Toolbar.clients'), 'link' => ''],
                  ['label' => trans('client.clients_table'), 'link' => '']
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ AddButton(route('admin.clients.create'))}}

        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card card-flush" style="border-top: 3px solid #007bff;">
             @php
             $headers=[
                       'client.ID',
                       'client.name',
                       'client.phone',
                       'client.email',
                       'client.projects',
                       'client.action',

                     ];

                 generateTable( $headers)
             @endphp
        </div>

    </div>












@stop
@section('js')




    <script>

        var KTDatatablesServerSide = function () {

            var table;
            var dt;
            var filterPayment;

            var initDatatable = function () {
                dt = $('#table').DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'f><'col-sm-12 col-md-4'B>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: "{{route('admin.clients.index')}}",
                    columns: [
                        {data: 'id', className: 'text-center no-export'},
                        {data: 'name', className: 'text-center'},
                        {data: 'phone', className: 'text-center'},
                        {data: 'email', className: 'text-center'},
                        {data: 'projects', className: 'text-center'},
                        {data: 'action', name: 'action', orderable: false, className: 'text-center no-export'},
                    ],
                    order: [[0, 'desc']],
                    columnDefs: [
                        {
                            "targets": [0, 1, 2, 3, 4],
                            "createdCell": function (td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',

                                });
                            }
                        },
                    ],
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="bi bi-file-earmark-spreadsheet-fill"></i>',
                            exportOptions: {
                                columns: ':visible:not(.no-export)'
                            }
                        }
                    ]
                });

                table = dt.$;

                dt.on('draw', function () {
                    KTMenu.createInstances();
                });
            }
            var handleDeleteRows = function () {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                KTUtil.on(document.body, '[data-kt-table-delete="delete_row"]', 'click', function (e) {
                    e.preventDefault();
                    const parent = e.target.closest('tr');
                    var action = e.target.getAttribute('href');

                    Swal.fire({
                        text: "{{ trans('forms.delete_quetion') }}?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "{{ trans('forms.delete_btn') }}",
                        cancelButtonText: "{{ trans('forms.action_no') }}",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            Swal.fire({
                                imageUrl: 'https://media.tenor.com/C7KormPGIwQAAAAi/epic-loading.gif',
                                imageWidth: 200,
                                imageHeight: 200,
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function () {
                                if (action) {
                                    fetch(action, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrfToken,


                                        },

                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })

                                        .then(data => {
                                            Swal.fire({
                                                text: "{{ trans('forms.Delete') }}",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "{{ trans('forms.action_done') }}",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary",
                                                }
                                            }).then(function () {
                                                dt.draw();
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error deleting:', error);
                                            Swal.fire({
                                                text: "{{ trans('forms.Delete') }}",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "{{ trans('forms.action_done') }}",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary",
                                                }
                                            }).then(function () {
                                                dt.draw();
                                            });
                                        });
                                }
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "{{ trans('forms.Delete') }}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{ trans('forms.action_done') }}",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            };

            return {
                init: function () {
                    initDatatable();
                    handleDeleteRows();
                }
            }
        }();
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
    </script>

@endsection

