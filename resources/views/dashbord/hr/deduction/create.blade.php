@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.hr'), 'link' => ''],
                  ['label' => trans('Toolbar.deduction'), 'link' => ''],
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ BackButton(route('admin.loans.index')) }}


        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.add_loan','admin.deductions.index',' ')
            @endphp


            <form action="{{ route('admin.deductions.store') }}" method="post" enctype="multipart/form-data"
                  id="store_form">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="mb-10 fv-row col">

                            <label class="required form-label">{{trans('loan.Employee_ID')}}

                            </label>


                            <select name="emp_id" id="emp_id"
                                    class="form-select @error('emp_id') is-invalid @enderror"
                                    data-control="select2"
                                    data-allow-clear="true"
                                    data-placeholder="{{trans('maindata.Select')}}">
                                @foreach($employees as $emp)
                                    <option
                                        value="{{ $emp->id }}">{{ $emp->first_name.' '.$emp->last_name .'( code-'.$emp->emp_code.')' }}</option>
                                @endforeach

                            </select>

                            @error('emp_id')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="mb-10 fv-row col">
                            <!--begin::Label-->
                            <label class="required form-label">{{trans('loan.value')}}

                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="value" id="value"

                                   class="form-control mb-2  @error('value') is-invalid @enderror"
                                   placeholder="value"/>
                            <!--end::Input-->
                            @error('value')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="mb-10 fv-row col">

                            <label class="required fs-6 fw-semibold mb-2">{{trans('loan.date_deductions')}}</label>
                            <input type="date" name="date_deductions"
                                   class="form-control form-control-solid @error('date_deductions') is-invalid  @enderror"
                                   value="{{old('date_deductions',date('Y-m-d'))}}"/>
                            @error('date_deductions')
                            <div
                                class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                    </div>

                    <div class="row">

                        <!--begin::Input group-->
                        <div class="row">
                            <div class="mb-10 fv-row col">
                                <!--begin::Label-->
                                <label class="form-label">{{trans('loan.Reason')}}
                                </label>

                                <textarea class="form-control @error('reason') is-invalid @enderror"
                                          data-kt-autosize="true"
                                          id="reason" name="reason"></textarea>
                                @error('reason')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->


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
            setTimeout(function () {
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


@endsection

