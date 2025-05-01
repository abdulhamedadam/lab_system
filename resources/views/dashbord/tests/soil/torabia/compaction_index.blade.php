@extends('dashbord.layouts.master')

@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
            $breadcrumbs = [
                ['label' => trans('Toolbar.home'), 'link' => route('admin.test.create')],
                ['label' => trans('Toolbar.tests'), 'link' => ''],
                ['label' => trans('Toolbar.soil_test'), 'link' => ''],
                ['label' => trans('Toolbar.soil'), 'link' => ''],
                ['label' => trans('Toolbar.compaction'), 'link' => ''],
              //  ['label' => trans('Toolbar.'), 'link' => ''],
            ];

            PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ AddButton(route('admin.soil_compaction_create_soil_test')) }}

        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                $headers = [
                    'tests.ID',
                    'tests.test_code',
                    'tests.client',
                    'tests.company',
                    'tests.project',
                    'tests.talab_title',
                  //  'tests.talab_image',
                    'tests.talab_date',
                    'tests.talab_end_date',
                    'tests.sample_number',
                    'tests.status',
                    'tests.actions',
                ];

                generateTable($headers);
            @endphp
        </div>

    </div>
    <div class="modal fade" tabindex="-1" id="testCostModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>
                </div>
                <form method="post" action="{{route('admin.add_test_cost')}}" enctype="multipart/form-data" id="form">
                    @csrf
                    <input type="hidden" name="row_id" id="row_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="talab_date" class="form-label">{{ trans('tests.sample_number') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="number" class="form-control" name="sample_number" id="sample_number"
                                           value="{{ old('sample_number', 1) }}" min="1" oninput="calculateTotal()" readonly>
                                </div>
                                @error('sample_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="sample_cost" class="form-label">{{ trans('tests.sample_cost') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="number" class="form-control" name="sample_cost" id="sample_cost"
                                           required
                                           value="{{ old('sample_cost') }}" step="0.01" min="0"
                                           oninput="calculateTotal()">
                                </div>
                                @error('sample_cost')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            @php
                                $discount_type=['p'=>trans('tests.percentage'),'v'=>trans('tests.value')]
                            @endphp

                            <div class="col-md-4">
                                <label for="discount_type" class="form-label">{{ trans('tests.discount_type') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <select class="form-select" name="discount_type" id="discount_type" required
                                            onchange="calculateTotal()">
                                        <option value="">{{trans('clients.select')}}</option>
                                        @foreach($discount_type as $index=>$value)
                                            <option
                                                value="{{$index}}" {{ old('discount_type') == $index ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('discount_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="discount" class="form-label">{{ trans('tests.discount') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="number" class="form-control" name="discount" id="discount" required
                                           value="{{ old('discount',0.00) }}" step="0.01" min="0"
                                           oninput="calculateTotal()">
                                </div>
                                @error('discount')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="total_cost" class="form-label">{{ trans('tests.total_cost') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="number" class="form-control" name="total_cost" id="total_cost" value=""
                                           readonly>
                                </div>
                                @error('total_cost')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="cost" class="form-label">{{ trans('tests.test_cost') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="number" class="form-control" name="cost" id="cost"
                                           value="{{ old('cost') }}" step="0.01" min="0">
                                </div>
                                @error('cost')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        function calculateTotal() {

            const sampleNumber = parseInt(document.getElementById('sample_number').value) || 1;
            const sampleCost = parseFloat(document.getElementById('sample_cost').value) || 0;
            const discountType = document.getElementById('discount_type').value;
            const discountValue = parseFloat(document.getElementById('discount').value) || 0;

            const baseCost = sampleCost * sampleNumber;
            let totalCost = baseCost;
            if (discountType && !isNaN(discountValue)) {
                if (discountType === 'p') {

                    const discountAmount = baseCost * (discountValue / 100);
                    totalCost = baseCost - discountAmount;
                } else if (discountType === 'v') {

                    totalCost = baseCost - discountValue;
                }
            }

            totalCost = Math.max(0, totalCost);
            document.getElementById('total_cost').value = totalCost.toFixed(2);
            document.getElementById('cost').value = totalCost.toFixed(2);
        }

        document.getElementById('testCostModal').addEventListener('shown.bs.modal', function () {
            calculateTotal();
        });
    </script>

    <script>
        $(document).ready(function () {
            //datatables
            table = $('#table1').DataTable({
                "language": {
                    url: "{{ asset('assets/Arabic.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "{{ route('admin.soil_compaction_soil_test') }}",
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
                        data: 'client',
                        className: 'text-center no-export'
                    },
                    {
                        data: 'company',
                        className: 'text-center'
                    },
                    {
                        data: 'project',
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
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'color': '#6610f2',

                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [3, 4],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [2],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({

                                'text-align': 'center',
                                'color': 'green',
                                'vertical-align': 'middle',
                            });
                        }
                    },

                    {
                        "targets": [5],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
                                'color': 'red',
                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [10],
                        "createdCell": function (td, cellData, rowData, row, col) {
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
        function confirmDelete(clientId) {
            Swal.fire({
                title: '{{ trans('employees.confirm_delete') }}',
                text: '{{ trans('clients.delete_warning') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ trans('employees.yes_delete') }}',
                cancelButtonText: '{{ trans('employees.cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + clientId).submit();
                }
            });
        }
    </script>
    <script>
        function showImagePopup(imageUrl) {
            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = '#fff';
            popup.style.padding = '10px';
            popup.style.border = '1px solid #ccc';
            popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.style.zIndex = 1000;

            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.maxWidth = '90vw';
            img.style.maxHeight = '90vh';

            const closeBtn = document.createElement('button');
            closeBtn.textContent = 'Close';
            closeBtn.style.marginTop = '10px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = () => {
                document.body.removeChild(popup);
            };

            popup.appendChild(img);
            popup.appendChild(closeBtn);
            document.body.appendChild(popup);
        }
    </script>
    <script>
        function edit_test_cost(id) {
            $.ajax({
                url: "{{ route('admin.get_test_sample', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function (data) {
                    var allData = data.all_data;
                    //console.log(allData);
                    $('#row_id').val(allData.id);
                    $('#sample_number').val(allData.sample_number);
                    $('.modal-title').text(allData.test_code_st);
                    $('#sample_cost').val(allData.sample_cost);
                    $('#discount').val(allData.discount);
                    $('#discount_type').val(allData.discount_type);
                    $('#total_cost').val(allData.total_cost);
                    $('#cost').val(allData.cost);

                },
            });
        }
    </script>

@endsection
