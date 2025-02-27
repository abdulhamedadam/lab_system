@extends('dashbord.layouts.master')
@section('style')
    <style>
        .btn-group, .btn-group-vertical {
            display:inline !important;
        }
    </style>

@endsection
@section('toolbar')

    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('account.create')}}</h1>

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
                    {{trans('Toolbar.account')}}
                </li>


            </ul>

        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">

            <div class="d-flex">
                <a href="{{route('admin.finance.accounts.create')}}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
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
                </a>
                <a href="" class="btn btn-icon btn-sm btn-info flex-shrink-0 ms-4">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
      fill="currentColor"/>
<path
    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
    fill="currentColor"/>
</svg>
</span>
                </a>

            </div>

        </div>

    </div>

@endsection
@section('content')


    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

            <div class="card-body pt-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">

                    <table  class="table table-bordered"
                           id="table1">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th class="text-center">{{trans('account.ID')}}</th>
                            <th class="text-center">{{trans('account.code')}}</th>
                            <th class="text-center">{{trans('account.name')}}</th>
                            <th class="text-center">{{trans('account.parent_account')}}</th>
                            <th class="text-center">{{trans('account.Action')}}</th>
                        </tr>
                        </thead>
                    </table>

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
                    url: "{{ route('admin.finance.accounts.index')}}",
                    type: 'GET'
                },
                "columns": [
                    {
                        data: 'id',
                        className: 'text-center no-export'
                    },
                    {
                        data: 'code',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        className: 'text-center no-export'
                    },
                    {
                        data: 'parent_account',
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

@endsection
