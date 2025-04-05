@extends('dashbord.layouts.master')

{{--<style>--}}
{{--    .jstree-default .jstree-anchor {--}}
{{--        font-size: 14px;--}}
{{--        padding: 2px 5px;--}}
{{--        border-radius: 4px;--}}
{{--        margin: 2px 0;--}}
{{--    }--}}

{{--    .jstree-default .jstree-icon {--}}
{{--        font-size: 16px;--}}
{{--    }--}}

{{--    /* Modified to target only the anchor elements */--}}
{{--    li.parent-node > .jstree-anchor {--}}
{{--        background-color: #d6b9b9;--}}
{{--        font-weight: 600;--}}
{{--        padding: 4px 8px;--}}
{{--    }--}}

{{--    li.parent-node > .jstree-anchor:hover {--}}
{{--        background-color: #bae6fd;--}}

{{--    }--}}

{{--    li.sub-node > .jstree-anchor {--}}
{{--        background-color: #dbeafe;--}}
{{--        padding: 4px 8px;--}}
{{--    }--}}

{{--    li.sub-node > .jstree-anchor:hover {--}}
{{--        background-color: #bfdbfe;--}}
{{--    }--}}

{{--    li.leaf-node > .jstree-anchor {--}}
{{--        background-color: #dcfce7;--}}
{{--        padding: 4px 8px;--}}
{{--    }--}}

{{--    li.leaf-node > .jstree-anchor:hover {--}}
{{--        background-color: #bbf7d0;--}}
{{--    }--}}

{{--    /* Keep these to prevent jsTree's default behavior */--}}
{{--    .jstree-default .jstree-wholerow-clicked {--}}
{{--        background: transparent !important;--}}
{{--    }--}}

{{--    .jstree-default .jstree-wholerow-hovered {--}}
{{--        background: transparent !important;--}}
{{--    }--}}
{{--</style>--}}
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
            $breadcrumbs = [
                ['label' => trans('Toolbar.home'), 'link' => route('admin.test.create')],
                ['label' => trans('Toolbar.tests'), 'link' => ''],
                ['label' => trans('Toolbar.all_tests'), 'link' => ''],
              //  ['label' => trans('Toolbar.'), 'link' => ''],
            ];

            PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ AddButton(route('admin.test.create')) }}

        </div>
    </div>

@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{trans('tests.samples_test')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">tests_data
                    <div id="kt_docs_jstree_customicons">
                        @php
                            $all_test=[
                                        'soil_test'=>[
                                                 'torabia'=>[
                                                    'name'=>'earthy',
                                                    'color'=>'#007bff',
                                                    'type'=>'',
                                                    'opened'=>'true',
                                                    'icon'=>'bi bi-layers-fill',
                                                    'test'=>[
                                                            'hadl'=>[
                                                                'name'=>'compaction',
                                                                'color'=>'bg-green-100',
                                                                'type'=>'',
                                                                'opened'=>'true',
                                                                'icon'=>'bi bi-tools',
                                                                // 'link'=>route('admin.soil_test',['soil','compaction']),
                                                                'link'=>route('admin.soil_compaction_soil_test'),
                                                            ],
                                                            'proctor'=>[
                                                                'name'=>'proctor',
                                                                'color'=>'bg-green-100',
                                                                'type'=>'',
                                                                'opened'=>'true',
                                                                'icon'=>'bi bi-clipboard-data',
                                                                'link'=>''
                                                            ],
                                                            'cbr'=>[
                                                                'name'=>'cbr',
                                                                'color'=>'bg-green-100',
                                                                'type'=>'',
                                                                'opened'=>'true',
                                                                'icon'=>'bi bi-graph-up',
                                                                'link'=>''
                                                            ],
                                                            'plasticity'=>[
                                                                'name'=>'plasticity',
                                                                'color'=>'bg-green-100',
                                                                'type'=>'',
                                                                'opened'=>'true',
                                                                'icon'=>'bi bi-moisture',
                                                                'link'=>''
                                                            ],
                                                     ]
                                                 ],
                                                 'hasa'=>[
                                                    'name'=>'earthy',
                                                    'color'=>'bg-blue-100',
                                                    'type'=>'',
                                                    'opened'=>'true',
                                                    'icon'=>'bi bi-layers-half',
                                                    'test'=>[
                                                       'hadl'=>[
                                                            'name'=>'compaction',
                                                            'color'=>'bg-green-100',
                                                            'type'=>'',
                                                            'opened'=>'true',
                                                            'icon'=>'bi bi-tools',
                                                            'link'=>route('admin.hasa_compaction_soil_test')
                                                       ],
                                                       'gradual'=>[
                                                            'name'=>'gradual',
                                                            'color'=>'bg-green-100',
                                                            'type'=>'',
                                                            'opened'=>'true',
                                                            'icon'=>'bi bi-bar-chart-steps',
                                                            'link'=>''
                                                       ],
                                                   ]
                                                 ],
                                                ],
                                        'concrete_type'=>[
                                                   'concrete'=>[
                                                        'name'=>'earthy',
                                                        'color'=>'bg-blue-100',
                                                        'type'=>'',
                                                        'opened'=>'true',
                                                        'icon'=>'bi bi-bricks'
                                                   ],
                                                   'aggregate'=>[
                                                        'name'=>'aggregate',
                                                        'color'=>'bg-blue-100',
                                                        'type'=>'',
                                                        'opened'=>'true',
                                                        'icon'=>'bi bi-grid-3x3-gap'
                                                   ],
                                                ],
                                      ];
                        @endphp


                        <ul>
                            @foreach ($all_test as $category => $subcategories)
                                <li class="parent-node" data-jstree='{
                                    "opened": true,
                                    "icon": "bi bi-folder-fill",
                                    "class": "parent-node"
                                    }'>
                                    {{trans('tests.'.$category)}}

                                    <ul>
                                        @foreach ($subcategories as $subcategoryKey => $subcategory)
                                            <li class="sub-node" data-jstree='{
                                                "opened": true,
                                                "icon": "{{ $subcategory["icon"] }}",
                                                "class": "sub-node"
                                                }'>

                                                {{trans('tests.'.$subcategoryKey)}}

                                                @if(isset($subcategory['test']) && is_array($subcategory['test']))
                                                    <ul>
                                                        @foreach ($subcategory['test'] as $testKey => $test)
                                                            <li class="leaf-node" data-jstree='{
                                                                "opened": true,
                                                                "icon": "{{ $test["icon"] }}",
                                                                "class": "leaf-node"
                                                                }'>
                                                                @if($test["link"])
                                                                    <a href="{{ $test["link"] }}">{{trans('tests.'.$testKey)}}</a>
                                                                @else

                                                                    {{trans('tests.'.$testKey)}}
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>




    <div class="card-body" style="padding-left: 0px !important;">
        <div id="kt_app_content_container" class="app-container container-xxxl">

            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                @php
                    $headers = [
                        'tests.ID',
                        'tests.test_code',
                        'tests.company',
                         'tests.type',
                         'tests.test_type',
                        'tests.sub_type',
                        'tests.talab_title',
                        'tests.talab_date',
                        'tests.talab_end_date',
                        'tests.sample_number',
                        'tests.sader_number',
                        'tests.sader_date',
                        'tests.status',

                        'tests.actions',
                    ];

                    generateTable($headers);
                @endphp
            </div>

        </div>


    </div>







@stop
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
                    url: "{{ route('admin.all_tests') }}",
                    type: 'GET'
                },
                "columns": [
                    {
                        data: 'id',
                        className: 'text-center no-export'
                    },
                    {
                        data: 'test_code',
                        className: 'text-center'
                    },

                    {
                        data: 'company',
                        className: 'text-center'
                    },
                    {
                        data: 'type',
                        className: 'text-center'
                    }, {
                        data: 'test_type',
                        className: 'text-center'
                    }, {
                        data: 'sub_type',
                        className: 'text-center'
                    },
                    {
                        data: 'talab_title',
                        className: 'text-center'
                    },
                    {
                        data: 'talab_date',
                        className: 'text-center'
                    },
                    {
                        data: 'talab_end_date',
                        className: 'text-center'
                    },
                    {
                        data: 'sample_number',
                        className: 'text-center'
                    },
                    {
                        data: 'sader_number',
                        className: 'text-center'
                    },
                    {
                        data: 'sader_date',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
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
                        "targets": [3, 4],
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

                    {
                        "targets": [5],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
                                'color': 'red',
                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [10],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
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
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
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
        $('#kt_docs_jstree_customicons').jstree({
            "core": {
                "themes": {
                    "responsive": false
                }
            },
            "types": {
                "default": {
                    "icon": "ki-outline ki-older text-warning"
                },
                "file": {
                    "icon": "ki-outline ki-file  text-warning"
                }
            },
            "plugins": ["types"]
        });

        $('#kt_docs_jstree_customicons').on('select_node.jstree', function (e, data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    </script>

@endsection
