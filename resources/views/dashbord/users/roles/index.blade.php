@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('roles.roles');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' =>''],
                  ['label' => trans('Toolbar.roles'), 'link' => ''],
                  ['label' => trans('Toolbar.roles_list'), 'link' => ''],


                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ AddButton(route('admin.roles.create')) }}


        </div>
    </div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="t_container"
         style="">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">


            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <h2>{{ trans('roles.roles_list') }}</h2>
                </div>

            </div>


            <div class="card-body">
                <div class="card-body">
                    <div class="">

                        {{-- views/admin/categories/index.blade.php --}}
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="text-align: center;">{{trans('roles.id')}}</th>
                                <th style="text-align: center;">{{trans('roles.name')}}</th>
                                <th style="text-align: center;">{{trans('users.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($roles as $role)
                                <tr>

                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center;">{{ $role->name }}</td>
                                    <td style="text-align: center;">
{{--                                        @can('add_role')--}}
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> {{ trans('roles.edit') }}
                                            </a>
{{--                                        @endcan--}}
{{--                                        @can('delete_role')--}}
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('{{ trans('users.delete_confirm') }}');">
                                                    <i class="bi bi-trash"></i> {{ trans('roles.delete') }}
                                                </button>
                                            </form>
{{--                                        @endcan--}}

                                        <a href="{{ route('admin.roles.permissions', $role->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-shield-lock"></i> {{ trans('users.permissions') }}
                                        </a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>


            </div>


        </div>
    </div>


@endsection

@section('js')

    <script>

        $(document).ready(function () {
            table = $('#table1').DataTable({
                "language": {
                    url: "{{ asset('assets/Arabic.json') }}"
                },
                "processing": true,
                "serverSide": false,
                "order": [],
                "columns": [
                    {data: 'id', className: 'text-center no-export'},
                    {data: 'name', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, className: 'text-center no-export'},
                ],
                "columnDefs": [
                    {
                        "targets": [1, -1], //last column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [1],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'color': '#6610f2',

                                'vertical-align': 'middle',
                            });
                        }
                    },

                    {
                        "targets": [2],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({
                                'font-weight': '600',
                                'text-align': 'center',
                                'color': 'green',
                                'vertical-align': 'middle',
                            });
                        }
                    },


                ],
                "order": [],
                "dom": '<"row align-items-center"<"col-md-3"l><"col-md-6"f><"col-md-3"B>>rt<"row align-items-center"<"col-md-6"i><"col-md-6"p>>',
                "buttons": [
                    {
                        "extend": 'excel',

                    },
                    {
                        "extend": 'copy',

                    },
                    {
                        "extend": 'print',

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
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "الكل"]],
            });

            $("input").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        });
    </script>
    <script>
        function showImagePopup(imageSrc) {
            // Create a div for the modal background
            let modal = document.createElement("div");
            modal.style.position = "fixed";
            modal.style.top = "0";
            modal.style.left = "0";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0,0,0,0.8)";
            modal.style.display = "flex";
            modal.style.justifyContent = "center";
            modal.style.alignItems = "center";
            modal.style.zIndex = "1000";

            // Create an image element
            let img = document.createElement("img");
            img.src = imageSrc;
            img.style.maxWidth = "90%";
            img.style.maxHeight = "90%";
            img.style.borderRadius = "10px";
            img.style.boxShadow = "0 4px 8px rgba(255,255,255,0.2)";

            // Close modal on click
            modal.onclick = function () {
                document.body.removeChild(modal);
            };

            modal.appendChild(img);
            document.body.appendChild(modal);
        }
    </script>



@endsection
