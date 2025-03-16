@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('Toolbar.external_test');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.company.index')],
                  ['label' => trans('Toolbar.external_test'), 'link' => ''],
                  ['label' => trans('project.create_external_test'), 'link' => '']
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ BackButton(route('admin.external_test.index'))}}

        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.create_external_test','admin.project.index',' ')
            @endphp


            <form action="{{ route('admin.external_test.store') }}" method="post" enctype="multipart/form-data"
                  id="store_form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.test_code') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test_code" id="test_code" value="">
                            </div>
                            @error('test_code')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.client') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select" data-control="select2" name="client_id" id="client_id">
                                    <option value="">{{trans('clients.select')}}</option>
                                    @foreach($clients as $item)
                                        <option
                                            value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addClientModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            @error('client_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.company') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select" data-control="select2" name="company_id" id="company_id">
                                    <option value="">{{trans('clients.select')}}</option>
                                    @foreach($companies as $item)
                                        <option
                                            value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCompanyModal">
                                    <i class="fas fa-plus "></i>
                                </button>
                            </div>
                            @error('company_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="last_name" class="form-label">{{ trans('tests.project') }}</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select" data-control="select2" name="project_id" id="project_id">
                                    <option value="">{{trans('clients.select')}}</option>
                                    @foreach($projects as $item)
                                        <option
                                            value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->project_name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addProjectModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            @error('project_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 row" style="margin-top: 20px">
                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.sample_num') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="sample_num" id="sample_num" value="">
                            </div>
                            @error('sample_num')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.sample_cost') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="sample_cost" id="sample_cost" value="">
                            </div>
                            @error('sample_cost')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        @php
                            $discount_type=['p'=>trans('tests.percentage'),'v'=>trans('tests.value')]
                        @endphp
                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.discount_type') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <select class="form-select" name="discount_type" id="discount_type">
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

                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.discount') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="discount" id="discount" value="">
                            </div>
                            @error('discount')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.total_cost') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="total_cost" id="total_cost" value="">
                            </div>
                            @error('total_cost')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12 row" style="margin-top: 20px">

                        <div class="col-md-4">
                            <label for="first_name" class="form-label">{{ trans('tests.test_type') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('mumber') !!}</span>
                                <input type="text" class="form-control" name="test_type" id="test_type" value="">
                            </div>
                            @error('test_type')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">{{ trans('tests.report_num') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('mumber') !!}</span>
                                <input type="number" class="form-control" name="report_num" id="report_num" value="">
                            </div>
                            @error('report_num')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="first_name" class="form-label">{{ trans('tests.report_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="report_date" id="report_date" value="">
                            </div>
                            @error('report_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-12 row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <label for="first_name" class="form-label">{{ trans('tests.notes') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('notes') !!}</span>
                                <textarea name="notes" id="notes" class="form-control">{{old('notes')}}</textarea>
                            </div>
                            @error('notes')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr style="margin-top:20px">


                    <div class="col-md-12 row" style="margin-top: 20px">
                        <div id="kt_docs_repeater_basic">
                            <div class="form-group">
                                <div data-repeater-list="kt_docs_repeater_basic">
                                    <div data-repeater-item>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="first_name" class="form-label">{{ trans('tests.invoice_num') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                                    <input type="number" class="form-control" name="invoice_num" id="invoice_num" value="">
                                                </div>
                                                @error('invoice_num')
                                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="first_name" class="form-label">{{ trans('tests.invoice_date') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                                    <input type="date" class="form-control" name="invoice_date" id="invoice_date" value="">
                                                </div>
                                                @error('invoice_date')
                                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-md-3">
                                                <label for="first_name" class="form-label">{{ trans('tests.value') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                                    <input type="number" class="form-control" name="value" id="value" value="">
                                                </div>
                                                @error('value')
                                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-5">
                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Add
                                </a>
                            </div>

                        </div>

                    </div>


                </div>


                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ trans('company.save') }}
                    </button>
                </div>
            </form>
        </div>


    </div>
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">{{ trans('clients.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="client_name" class="form-label">{{ trans('clients.name') }}</label>
                        <input type="text" class="form-control" id="client_name" name="client_name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" onclick="saveClient()" class="btn btn-primary"
                            id="saveClient">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyModalLabel">{{ trans('companies.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="company_name" class="form-label">{{ trans('companies.name') }}</label>
                        <input type="text" class="form-control" id="company_name" name="company_name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" class="btn btn-primary" onclick="saveCompany()"
                            id="saveCompany">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">{{ trans('projects.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="project_name" class="form-label">{{ trans('projects.name') }}</label>
                        <input type="text" class="form-control" id="project_name" name="project_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" class="btn btn-primary" onclick="saveProject()"
                            id="saveProject">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>











@stop
@section('js')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("#client_id").trigger("change");
            }, 300);
        });
    </script>
    <script>
        var saveClientUrl = "{{ route('admin.save_client_popup') }}";
        var saveCompanyUrl = "{{ route('admin.save_company_popup') }}";
        var saveProjectUrl = "{{ route('admin.save_project_popup') }}";

        function saveClient() {
            var clientName = $('#client_name').val();
            if (clientName) {
                $.ajax({
                    url: saveClientUrl, // ✅ Use the JS variable
                    type: 'POST',
                    data: {
                        name: clientName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#client_id').append(new Option(data.client.name, data.client.id, true, true));
                            if ($.fn.select2) {
                                $('#client_id').trigger('change');
                            }
                            $('#addClientModal').modal('hide');
                            $('#client_name').val('');
                        }
                    }
                });
            }
        }

        function saveCompany() {
            var companyName = $('#company_name').val();
            if (companyName) {
                $.ajax({
                    url: saveCompanyUrl, // ✅ Use the JS variable
                    type: 'POST',
                    data: {
                        name: companyName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#company_id').append(new Option(data.company.name, data.company.id, true, true));
                            if ($.fn.select2) {
                                $('#company_id').trigger('change');
                            }
                            $('#addCompanyModal').modal('hide');
                            $('#company_name').val('');
                        }
                    }
                });
            }
        }

        function saveProject() {
            var projectName = $('#project_name').val();
            if (projectName) {
                $.ajax({
                    url: saveProjectUrl,
                    type: 'POST',
                    data: {
                        project_name: projectName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#project_id').append(new Option(data.project.project_name, data.project.id, true, true));
                            if ($.fn.select2) {
                                $('#project_id').trigger('change');
                            }
                            $('#addProjectModal').modal('hide');
                            $('#project_name').val('');
                        }
                    }
                });
            }
        }

    </script>
    <script>

        function saveClient() {
            var clientName = $('#client_name').val();
            if (clientName) {
                $.ajax({
                    url: {{route('admin.save_client_popup')}},
                    type: 'POST',
                    data: {
                        name: clientName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#client_id').append(new Option(data.client.name, data.client.id, true, true));
                            if ($.fn.select2) {
                                $('#client_id').trigger('change');
                            }
                            $('#addClientModal').modal('hide');
                            $('#client_name').val('');
                        }
                    }
                });
            }
        }

        function saveCompany() {
            var companyName = $('#company_name').val();
            if (companyName) {
                $.ajax({
                    url: {{route('admin.save_company_popup')}},
                    type: 'POST',
                    data: {
                        name: companyName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {

                            $('#company_id').append(new Option(data.company.name, data.company.id, true, true));

                            if ($.fn.select2) {
                                $('#company_id').trigger('change');
                            }

                            $('#addCompanyModal').modal('hide');

                            $('#company_name').val('');
                        }
                    }
                });
            }
        }


        function saveProject() {
            var projectName = $('#project_name').val();
            if (projectName) {

                $.ajax({
                    url: {{route('admin.save_project_popup')}},
                    type: 'POST',
                    data: {
                        project_name: projectName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#project_id').append(new Option(data.project.project_name, data.project.id, true, true));

                            if ($.fn.select2) {
                                $('#project_id').trigger('change');
                            }

                            $('#addProjectModal').modal('hide');

                            $('#project_name').val('');
                        }
                    }
                });
            }
        }

    </script>

    <script>
        $(document).ready(function () {
            function calculateTotalCost() {
                var sampleNum = parseFloat($('#sample_num').val()) || 0;
                var sampleCost = parseFloat($('#sample_cost').val()) || 0;
                var discountType = $('#discount_type').val();
                var discount = parseFloat($('#discount').val()) || 0;
                var subtotal = sampleNum * sampleCost;
                var discountAmount = 0;
                if (discountType === 'p') {
                    discountAmount = subtotal * (discount / 100);
                } else if (discountType === 'v') {
                    discountAmount = discount;
                }
                var totalCost = subtotal - discountAmount;
                totalCost = Math.max(0, totalCost);
                $('#total_cost').val(totalCost.toFixed(2));
            }

            $('#sample_num, #sample_cost, #discount_type, #discount').on('input change', function () {
                calculateTotalCost();
            });
            calculateTotalCost();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                    calculateTotal();
                    $(this).find('input[id="value"]').on('input', function() {
                        calculateTotal();
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                    setTimeout(function() {
                        calculateTotal();
                    }, 500);
                }
            });
            $(document).on('input', 'input[id="value"]', function() {
                calculateTotal();
            });

            if ($('#invoice_total_container').length === 0) {
                $('#kt_docs_repeater_basic').after(
                    '<div id="invoice_total_container" class="col-md-12 d-flex justify-content-end mt-5">' +
                    '<div class="bg-light p-4 rounded">' +
                    '<h4 class="fw-bold mb-0">' +
                    'Total: <span id="invoice_total_value">0.00</span>' +
                    '</h4>' +
                    '</div>' +
                    '</div>'
                );
            }

            calculateTotal();
            function calculateTotal() {
                let total = 0;
                $('input[id="value"]').each(function() {
                    let val = parseFloat($(this).val()) || 0;
                    total += val;
                });

                $('#invoice_total_value').text(total.toFixed(2));
            }
        });
    </script>


    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function () {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



@endsection

