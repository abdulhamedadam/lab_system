@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
            $breadcrumbs = [
                ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                ['label' => trans('Toolbar.tests'), 'link' => ''],
                ['label' => trans('Toolbar.soil_test'), 'link' => ''],
                ['label' => trans('Toolbar.hasa'), 'link' => ''],
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
                generateCardHeader('tests.add_test', 'admin.test.index', ' ');
            @endphp


            <form action="{{ route('admin.hasa_compaction_store_soil_test') }}" method="post" enctype="multipart/form-data"
                id="store_form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12 row" style="margin-top: 10px">

                        <div class="col-md-3">
                            <label for="test_code" class="form-label">{{ trans('tests.test_code') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test_code" id="test_code"
                                    value="{{ get_app_config_data('soil_prefix') . $test_code }}">
                            </div>
                            @error('test_code')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.client') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" data-control="select2" name="client_id"
                                    id="client_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($clients as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('client_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" onclick="show_settings('clients', 'client_id')"
                                    style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                    <i class="fa-solid fa-plus"></i>
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
                                <select class="form-select rounded-start-0" data-control="select2" name="company_id"
                                    id="company_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($companies as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('company_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary"
                                    onclick="show_settings('companies', 'company_id')" style="padding: 10px !important;"
                                    data-bs-toggle="modal" data-bs-target="#add_setting">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            @error('company_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="project_id" class="form-label">{{ trans('tests.project') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" data-control="select2" name="project_id"
                                    id="project_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($projects as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('project_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->project_name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary"
                                    onclick="show_settings('projects', 'project_id')" style="padding: 10px !important;"
                                    data-bs-toggle="modal" data-bs-target="#add_setting">
                                    <i class="fa-solid fa-plus"></i>
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
                                    value="{{ old('wared_number', $wared_number) }}">
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
                                    value="{{ old('wared_date', $wared_number) }}">
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
                                    value="{{ old('talab_number', $talab_number) }}">
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
                            <label for="talab_date" class="form-label">{{ trans('tests.sample_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="sample_number" id="sample_number"
                                    value="{{ old('sample_number') }}">
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
                                <input type="number" class="form-control" name="book_number" id="book_number"
                                    value="{{ old('book_number', $book_number) }}">
                            </div>
                            @error('book_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.test_cost') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="cost" id="cost"
                                    value="{{ old('cost') }}">
                            </div>
                            @error('cost')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        @php
                            $test_type = ['soil' => trans('tests.soil'), 'hasa' => trans('tests.hasa')];
                        @endphp
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.soil_test_type') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="test_type" id="test_type" disabled>
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($test_type as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('test_type', 'hasa') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>



                        @php
                            $tests = [
                                'compaction' => trans('tests.compaction'),
                                'proctor' => trans('tests.proctor'),
                                'cbr' => trans('tests.cbr'),
                                'plasticity' => trans('tests.plasticity'),
                                'salt_gypsum' => trans('tests.salt_gypsum'),
                                'salt_organic' => trans('tests.salt_organic'),
                                'shear' => trans('tests.shear'),
                                'unconfined_compression' => trans('tests.unconfined_compression'),
                                'gradual' => trans('tests.gradual'),
                            ];
                        @endphp

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.tests') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="sub_test_type" id="sub_test_type"
                                    disabled>
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($tests as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('test_type', 'compaction') == $key ? 'selected' : '' }}>
                                            {{ trans('soil.' . $value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.authorized_name') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="authorized_name" id="authorized_name"
                                    value="{{ old('authorized_name') }}">
                            </div>
                            @error('authorized_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.monamzig') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="monamzig_id" id="monamzig_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach ($employees as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('monamzig_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->first_name . '' . $item->last_name }}</option>
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

    <div class="modal fade" id="add_setting" tabindex="-1" aria-labelledby="addNationalityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <span id="success_message" class="text-success d-none"
                            style="width:100%;background-color: #98d298;text: white;padding: 10px; border-radius: 5px; margin-top: 10px; margin-bottom: 10px;"></span>

                    </div>
                    <br>
                    <div id="show_setting">



                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function() {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>
    <script>
        function show_settings(type, input_id) {
            $('#title_modal').text('Add ' + type);
            $.ajax({
                url: "{{ route('admin.show_setting') }}",
                type: "get",
                data: {
                    type: type,
                    input_id: input_id
                },
                dataType: "html",
                success: function(html) {
                    $('#show_setting').html(html);
                },
            });
        }
    </script>

    <script>
        // function add_setting(type, input_id) {
        //     var title = $('#title_setting').val();

        //     if (title.trim() !== '') {
        //         $.ajax({
        //             url: "{{ route('admin.add_popup_setting') }}",
        //             type: "post",
        //             data: {
        //                 title: title,
        //                 type: type
        //             },
        //             dataType: "json",
        //             success: function(response) {
        //                 show_settings(type);
        //                 var newOption = new Option(response.title, response.id, true, true);
        //                 $('#' + input_id).append(newOption).trigger('change');
        //                 showSuccessMessage('Setting added successfully!');
        //             },
        //         });
        //     } else {
        //         $('#error_title').text('هذا الحق ضروري!');
        //     }
        // }
        // function add_clients() {
        //     var name = $('#name').val().trim();
        //     var email = $('#email').val().trim();
        //     var governate = $('#governate').val();
        //     var city = $('#city').val();

        //     if (name === '' || email === '' || governate === '' || city === '') {
        //         alert('All fields are required!');
        //         return;
        //     }

        //     $.ajax({
        //         url: "{{ route('admin.add_clients') }}",
        //         type: "POST",
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             name: name,
        //             email: email,
        //             governate: governate,
        //             city: city
        //         },
        //         dataType: "json",
        //         success: function(response) {
        //             if (response.success) {
        //                 $('#table1 tbody').append(`
    //                     <tr>
    //                         <td style="text-align: center">${response.client.id}</td>
    //                         <td style="text-align: center">${response.client.name}</td>
    //                         <td style="text-align: center">${response.client.email}</td>
    //                         <td style="text-align: center">${response.client.governate}</td>
    //                         <td style="text-align: center">
    //                             <a onclick="edit_setting(${response.client.id}, '${response.client.name}', '${response.client.email}', '${response.client.phone}')"
    //                                 class="btn btn-sm btn-warning edit-btn">
    //                                 <i class="bi bi-pencil"></i>
    //                             </a>
    //                             <a onclick="delete_setting(${response.client.id}, 'clients')"
    //                                 class="btn btn-sm btn-danger">
    //                                 <i class="bi bi-trash"></i>
    //                             </a>
    //                         </td>
    //                     </tr>
    //                 `);
        //                 alert('Client added successfully!');
        //                 $('#name').val('');
        //                 $('#email').val('');
        //                 $('#governate').val('');
        //                 $('#city').val('');
        //             } else {
        //                 alert('Failed to add client.');
        //             }
        //         },
        //         error: function(xhr) {
        //             alert('An error occurred: ' + xhr.responseJSON.message);
        //         }
        //     });
        // }
        function add_setting(type, input_id) {
            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var governate = $('#governate').val();
            var city = $('#city').val();

            if (name !== '' && email !== '' && governate !== '') {
                $.ajax({
                    url: "{{ route('admin.add_popup_setting') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        type: type,
                        name: name,
                        email: email,
                        governate: governate,
                        city: city
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.id) {
                            showSuccessMessage('Client added successfully!');

                            // Append the new client to a table if needed
                            // var newRow = `
                        //     <tr>
                        //         <td>${response.id}</td>
                        //         <td>${response.name}</td>
                        //         <td>${response.email}</td>
                        //         <td>${response.governate}</td>
                        //         <td>
                        //             <a onclick="edit_setting(${response.id}, 'clients')" class="btn btn-sm btn-warning">
                        //                 <i class="bi bi-pencil"></i> Edit
                        //             </a>
                        //             <a onclick="delete_setting(${response.id}, 'clients')" class="btn btn-sm btn-danger">
                        //                 <i class="bi bi-trash"></i> Delete
                        //             </a>
                        //         </td>
                        //     </tr>
                        // `;
                            // $("#table1 tbody").append(newRow);
                            show_settings(type);
                            // Add new option to dropdown
                            var newOption = new Option(response.name, response.id, true, true);
                            $('#' + input_id).append(newOption).trigger('change');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error adding client!');
                    }
                });
            } else {
                alert('All fields are required!');
            }
        }
        // function add_setting(type, input_id) {
        //     var formData = new FormData(document.getElementById(type + '_form'));

        //     $.ajax({
        //         url: "{{ route('admin.add_popup_setting') }}",
        //         type: "post",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             show_settings(type, input_id);
        //             var newOption = new Option(response.name, response.id, true, true);
        //             $('#' + input_id).append(newOption).trigger('change');
        //             showSuccessMessage('Setting added successfully!');
        //         },
        //     });
        // }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>


@endsection
