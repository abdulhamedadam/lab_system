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


            <form action="{{ route('admin.external_test.store') }}" method="post" enctype="multipart/form-data" id="store_form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12 row" style="margin-top: 10px">

                        <div class="col-md-3">
                            <label for="test_code" class="form-label">{{ trans('tests.test_code') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test_code_st" id="test_code_st" value="{{ get_app_config_data('soil_prefix').$test_code }}" >
                            </div>
                            @error('test_code')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.client') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" onchange="get_company(this.value)"  data-control="select2" name="client_id" id="client_id">
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($clients as $item)
                                        <option value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                            <label for="company_id" class="form-label">{{ trans('tests.company') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" onchange="get_projects(this.value)"  data-control="select2" name="company_id" id="company_id">
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($companies as $item)
                                        <option value="{{$item->id}}" {{ old('company_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                {!! saveCompanyButtonWithModal() !!}
                            </div>
                            @error('company_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="project_id" class="form-label">{{ trans('tests.project') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" data-control="select2" name="project_id" id="project_id">
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($projects as $item)
                                        <option value="{{$item->id}}" {{ old('project_id') == $item->id ? 'selected' : '' }}>{{$item->project_name}}</option>
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

                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.wared_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="wared_number" id="wared_number"
                                       value="{{ old('wared_number',$wared_number) }}">
                            </div>
                            @error('wared_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.wared_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="date" class="form-control" name="wared_date" id="wared_date"
                                       value="{{ old('wared_date',$wared_number) }}">
                            </div>
                            @error('wared_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.talab_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="talab_number" id="talab_number"
                                       value="{{ old('talab_number',$talab_number) }}">
                            </div>
                            @error('talab_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_title" class="form-label">{{ trans('tests.talab_title') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="talab_title" id="talab_title"
                                       value="{{ old('talab_title') }}">
                            </div>
                            @error('talab_title')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_image" class="form-label">{{ trans('tests.talab_image') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('image') !!}</span>
                                <input type="file" class="form-control" name="talab_image" id="talab_image">
                            </div>
                            @error('talab_image')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.talab_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="talab_date" id="talab_date"
                                       value="{{ old('talab_date') }}">
                            </div>
                            @error('talab_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_end_date" class="form-label">{{ trans('tests.talab_end_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="talab_end_date" id="talab_end_date"
                                       value="{{ old('talab_end_date') }}">
                            </div>
                            @error('talab_end_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.sample_num') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="sample_num" id="sample_num" value="">
                            </div>
                            @error('sample_num')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>



                    <div class="col-md-12 row" style="margin-top: 20px">
                        @php
                            $test_type=['soil'=>trans('tests.soil'),'concrete'=>trans('tests.concrete'),'roads'=>trans('tests.roads'),'mechanic'=>trans('tests.mechanic')]
                        @endphp
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.soil_test_type') }}</label>
                            <div class="input-group flex-nowrap">

                                <select class="form-select rounded-start-0" name="test_category" id="test_category">
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($test_type as $key=>$value)
                                        <option
                                            value="{{$key}}" {{ old('test_category') == $key ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_category')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="first_name" class="form-label">{{ trans('tests.test_sub_category') }}</label>
                            <div class="input-group flex-nowrap">

                                <input type="text" class="form-control" name="test_sub_category" id="test_sub_category"
                                       value="{{old('test_sub_category')}}">
                            </div>
                            @error('test_sub_category')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.test') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test" id="test" value="{{old('test')}}">
                            </div>
                            @error('test')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.sader_date') }}</label>
                            <div class="input-group flex-nowrap">

                                <input type="date" class="form-control" name="sader_date" id="sader_date" value="{{old('sader_date')}}">
                            </div>
                            @error('sader_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="first_name" class="form-label">{{ trans('tests.sader_number') }}</label>
                            <div class="input-group flex-nowrap">

                                <input type="number" class="form-control" name="sader_num" id="sader_num" value="{{old('sader_num')}}">
                            </div>
                            @error('sader_num')
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
                                                <label for="first_name"
                                                       class="form-label">{{ trans('tests.invoice_num') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"
                                                          id="basic-addon3">{!! form_icon('number') !!}</span>
                                                    <input type="number" class="form-control" name="invoice_num"
                                                           id="invoice_num" value="">
                                                </div>
                                                @error('invoice_num')
                                                <span class="invalid-feedback d-block"
                                                      role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="first_name"
                                                       class="form-label">{{ trans('tests.invoice_date') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"
                                                          id="basic-addon3">{!! form_icon('date') !!}</span>
                                                    <input type="date" class="form-control" name="invoice_date"
                                                           id="invoice_date" value="">
                                                </div>
                                                @error('invoice_date')
                                                <span class="invalid-feedback d-block"
                                                      role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-md-3">
                                                <label for="first_name"
                                                       class="form-label">{{ trans('tests.value') }}</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"
                                                          id="basic-addon3">{!! form_icon('number') !!}</span>
                                                    <input type="number" class="form-control" name="value" id="value"
                                                           value="">
                                                </div>
                                                @error('value')
                                                <span class="invalid-feedback d-block"
                                                      role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <a href="javascript:;" data-repeater-delete
                                                   class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span><span
                                                            class="path4"></span><span class="path5"></span></i>
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
                        <label for="project_name" class="form-label">{{ trans('projects.client') }}</label>
                        <select type="text" class="form-select"  id="client_id_modal" name="client_id_modal">
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="project_name" class="form-label">{{ trans('projects.company') }}</label>
                        <select type="text" class="form-select" id="company_id_modal" name="company_id_modal">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
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
        $(document).ready(function() {
            setTimeout(function() {
                $("#client_id").trigger("change");
            }, 300);
        });
    </script>
    <script>
        function get_company(id)
        {
            $.ajax({
                url: "{{ route('admin.get_company', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    // console.log(html);
                    $('#company_id').html(html);
                    $('#company_id').val(<?= old('company_id')?> );
                },
            });
        }

        function get_projects(company_id) {
            var client_id = $('#client_id').val();

            $.ajax({
                url: "{{ route('admin.get_project', ['client_id' => '__client__', 'company_id' => '__company__']) }}"
                    .replace('__client__', client_id)
                    .replace('__company__', company_id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#project_id').html(html);
                    $('#project_id').val("{{ old('project_id') }}");
                },
            });
        }


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
            var client_id = $('#client_id_modal').val();
            var company_id = $('#company_id_modal').val();
            if (projectName) {
                $.ajax({
                    url: saveProjectUrl,
                    type: 'POST',
                    data: {
                        project_name: projectName,
                        company_id: company_id,
                        client_id: client_id,

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
        $(document).ready(function () {
            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,
                show: function () {
                    $(this).slideDown();
                    calculateTotal();
                    $(this).find('input[id="value"]').on('input', function () {
                        calculateTotal();
                    });
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                    setTimeout(function () {
                        calculateTotal();
                    }, 500);
                }
            });
            $(document).on('input', 'input[id="value"]', function () {
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
                $('input[id="value"]').each(function () {
                    let val = parseFloat($(this).val()) || 0;
                    total += val;
                });

                $('#invoice_total_value').text(total.toFixed(2));
            }
        });
    </script>




    <script>
        $(document).ready(function () {
            $('#sader_date').on('change', function () {
                var selectedDate = $(this).val();
                var currentYear = new Date().getFullYear();

                if (selectedDate) {
                    $.ajax({
                        url: "{{ route('admin.check_sader_date') }}",
                        method: 'GET',
                        data: {
                            date: selectedDate,
                            year: currentYear
                        },
                        success: function (response) {
                            if (response.exists) {

                                var numbers = Array.isArray(response.next_number) ? response.next_number : [];

                                var numbersOptions = '<option value="">Select Number</option>'; // Default placeholder
                                numbers.forEach(function (number) {
                                    numbersOptions += '<option value="' + number + '">' + number + '</option>';
                                });

                                $('#sader_num').replaceWith(`
                            <select class="form-control" name="sader_num" id="sader_num">
                                ${numbersOptions}
                            </select>
                        `);
                            } else {
                                var nextNumber = response.next_number;
                                console.log('nextNumber =', nextNumber);

                                $('#sader_num').replaceWith(`
                            <input type="number" step="any" class="form-control" name="sader_num" id="sader_num" value="${nextNumber}">
                        `);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });

    </script>
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



@endsection

