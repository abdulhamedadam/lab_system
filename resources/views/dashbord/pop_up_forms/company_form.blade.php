{{-- <form id="company_form">
    @csrf
    <div class="mb-3">
        <label for="company_name" class="form-label">Company Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" required>
    </div>
    <div class="mb-3">
        <label for="company_address" class="form-label">Company Address</label>
        <input type="text" class="form-control" id="company_address" name="company_address" required>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_setting('companies', '{{ $input_id }}')">Save</button>
</form> --}}

<div class="row">
    <input type="hidden" name="id" id="id" value="">
    <div class="col-md-8">
        <label for="projectName" class="form-label">{{ trans('company.name') }}</label>
        <input type="text" class="form-control" id="project_name" name="project_name" required>
        <span id="error_name" class="invalid-feedback d-block"></span>
    </div>
    <div class="col-md-8">
        <label for="projectDescription" class="form-label">{{ trans('company.description') }}</label>
        <textarea class="form-control" id="project_description" name="project_description" required></textarea>
    </div>
    <div id="save-btn" class="col-md-2" style="margin: 28px;display: block">
        <button type="button" onclick="add_setting('projects', '{{ $input_id }}')" class="btn btn-success">{{ trans('company.save') }}</button>
    </div>
    <div id="update-btn" class="col-md-2" style="margin: 28px;display: none">
        <button type="button" onclick="update_setting('projects', '{{ $input_id }}')" class="btn btn-success">{{ trans('company.update') }}</button>
    </div>
</div>

<br>
<br>
@if($companies->count())
    <div class="table-responsive">
        <table id="table1" class="table table-bordered">
            <thead>
            <tr class="fw-bold fs-6 text-gray-800">
                <th style="width: 5%">{{ trans('company.m') }}</th>
                <th style="text-align: center">{{ trans('company.name') }}</th>
                <th style="text-align: center">{{ trans('company.description') }}</th>
                <th style="width: 20%; text-align: center">{{ trans('company.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php $x = 0; @endphp
            @foreach($companies as $row)
                <tr>
                    <td style="text-align: center">{{ $x++ }}</td>
                    <td style="text-align: center">{{ $row->name }}</td>
                    <td style="text-align: center">{{ $row->description }}</td>
                    <td style="text-align: center">
                        <a onclick="edit_setting({{ $row->id }}, '{{ $input_id }}', '{{ $row->name }}', '{{ $row->description }}')" class="btn btn-sm btn-warning edit-btn" title="{{ trans('company.edit') }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="delete_setting({{ $row->id }}, 'projects', '{{ $input_id }}')" class="btn btn-sm btn-danger" title="{{ trans('company.delete') }}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>{{ trans('company.No data available') }}</p>
@endif

<script type="text/javascript">
    var save_method; // For the save method string
    var table;
    var dt;
</script>
<script>
    "use strict";
    var KTDatatablesServerSide = function () {
        var initDatatable = function () {
            table = $("#table1").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: false,
                order: [[1, 'desc']],
                stateSave: true,
            });
        };

        return {
            init: function () {
                initDatatable();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });
</script>
