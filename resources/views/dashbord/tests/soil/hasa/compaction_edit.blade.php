@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.tests'), 'link' => ''],
                  ['label' => trans('Toolbar.soil_test'), 'link' => ''],
                  ['label' => trans('Toolbar.soil'), 'link' => ''],
                  ['label' => trans('Toolbar.compaction'), 'link' => ''],
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ BackButton(route('admin.hasa_compaction_soil_test')) }}


        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.edit_test','admin.test.index',' ')
            @endphp


            <form action="{{ route('admin.hasa_compaction_update_soil_test',$all_data->id) }}" method="post" enctype="multipart/form-data" id="store_form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="test_code" class="form-label">{{ trans('tests.test_code') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test_code" id="test_code" value="{{ $all_data->test_code_st }}" >
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
                                        <option value="{{$item->id}}" {{ old('client_id',$all_data->client_id) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                                        <option value="{{$item->id}}" {{ old('company_id',$all_data->company_id) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                {{-- {!! saveCompanyButtonWithModal() !!} --}}
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
                                        <option value="{{$item->id}}" {{ old('project_id',$all_data->project_id) == $item->id ? 'selected' : '' }}>{{$item->project_name}}</option>
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
                                <input type="number" class="form-control" name="wared_number" id="wared_number" value="{{ old('wared_number',$all_data->wared_number) }}">
                            </div>
                            @error('wared_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.wared_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="date" class="form-control" name="wared_date" id="wared_date" value="{{ old('wared_date',$all_data->wared_date) }}">
                            </div>
                            @error('wared_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.talab_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="talab_number" id="talab_number" value="{{ old('talab_number',$all_data->talab_number) }}">
                            </div>
                            @error('talab_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_title" class="form-label">{{ trans('tests.talab_title') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="talab_title" id="talab_title" value="{{ old('talab_title',$all_data->talab_title) }}">
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
                                <input type="date" class="form-control" name="talab_date" id="talab_date" value="{{ old('talab_date',$all_data->talab_date) }}">
                            </div>
                            @error('talab_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_end_date" class="form-label">{{ trans('tests.talab_end_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="talab_end_date" id="talab_end_date" value="{{ old('talab_end_date',$all_data->talab_end_date) }}">
                            </div>
                            @error('talab_end_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.sample_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="sample_number" id="sample_number" value="{{ old('sample_number',$all_data->sample_number) }}">
                            </div>
                            @error('sample_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>








                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.book_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="book_number" id="book_number" value="{{ old('book_number',$all_data->book_number) }}">
                            </div>
                            @error('book_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        @php
                            $test_type=['soil'=>trans('tests.soil'),'hasa'=>trans('tests.hasa')]
                        @endphp
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.soil_test_type') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="test_type" id="test_type" disabled>
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($test_type as $key=>$value)
                                        <option value="{{$key}}" {{ old('test_type','soil') == $key ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>



                        @php
                            $tests=['compaction'=>trans('tests.compaction'),
                                    'proctor'=>trans('tests.proctor'),
                                     'cbr'=>trans('tests.cbr'),
                                     'plasticity'=>trans('tests.plasticity'),
                                     'salt_gypsum'=>trans('tests.salt_gypsum'),
                                     'salt_organic'=>trans('tests.salt_organic'),
                                     'shear'=>trans('tests.shear'),
                                     'unconfined_compression'=>trans('tests.unconfined_compression'),
                                     'gradual'=>trans('tests.gradual')];
                        @endphp

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.tests') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="sub_test_type" id="sub_test_type" disabled>
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($tests as $key=>$value)
                                        <option value="{{$key}}" {{ old('test_type','compaction') == $key ? 'selected' : '' }}>{{ trans('soil.'.$value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.authorized_name') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="authorized_name" id="authorized_name" value="{{ old('authorized_name',$all_data->authorized_name) }}">
                            </div>
                            @error('authorized_name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-12 row" style="margin-top: 10px">


                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.monamzig') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="monamzig_id" id="monamzig_id" >
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($employees as $item)
                                        <option value="{{$item->id}}" {{ old('monamzig_id',$all_data->monamzig_id) == $item->id ? 'selected' : '' }}>{{$item->first_name.''.$item->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('monamzig_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>






                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ trans('tests.save') }}
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
                $("#company_id").trigger("change");

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
                    $('#company_id').val(<?= old('company_id',$all_data->company_id)?> );
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
                    $('#project_id').val("{{ old('project_id',$all_data->project_id) }}");
                },
            });
        }


    </script>

    <script>
        $(document).ready(function () {
            function calculateTotalCost() {
                var sampleNum = parseFloat($('#sample_number').val()) || 0;
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
                $('#cost').val(totalCost.toFixed(2));
            }

            $('#sample_number, #sample_cost, #discount_type, #discount').on('input change', function () {
                calculateTotalCost();
            });
            calculateTotalCost();
        });
    </script>
    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function() {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


@endsection

