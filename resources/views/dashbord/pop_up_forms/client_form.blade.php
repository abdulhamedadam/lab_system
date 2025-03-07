{{-- <form id="client_form">
    @csrf
    <div class="mb-3">
        <label for="client_name" class="form-label">Client Name</label>
        <input type="text" class="form-control" id="client_name" name="client_name" required>
    </div>
    <div class="mb-3">
        <label for="client_email" class="form-label">Client Email</label>
        <input type="email" class="form-control" id="client_email" name="client_email" required>
    </div>
    <div class="mb-3">
        <label for="client_phone" class="form-label">Client Phone</label>
        <input type="text" class="form-control" id="client_phone" name="client_phone" required>
    </div>
    <button type="button" class="btn btn-primary" onclick="add_setting('clients', '{{ $input_id }}')">Save</button>
</form> --}}
<div class="row">
    <input type="hidden" name="id" id="id" value="">
    <div class="col-md-4">
        <label for="first_name" class="form-label">{{ trans('clients.name') }}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        @error('name')
            <span class="fv-plugins-message-container " role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="email" class="form-label">{{ trans('clients.email') }}</label>
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="basic-addon3">{!! form_icon('email') !!}</span>
            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>
        @error('email')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="basic-url"class="form-label">{{ trans('clients.governate') }}</label>
        <div class="input-group flex-nowrap ">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
            <div class="overflow-hidden flex-grow-1">
                <select class="form-select rounded-start-0" name="governate" id="governate"
                    onchange="get_area(this.value)" data-placeholder="{{ trans('clients.select') }}">
                    <option value="">{{ trans('clients.select') }}</option>
                    @foreach ($governates as $item)
                        <option value="{{ $item->id }}" {{ old('governate') == $item->id ? 'selected' : '' }}>
                            {{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('governate_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="basic-url" class="form-label">{{ trans('clients.area') }}</label>
        <div class="input-group flex-nowrap ">
            <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
            <div class="overflow-hidden flex-grow-1">
                <select class="form-select rounded-start-0" name="city" id="city" value="{{ old('city') }}"
                    data-placeholder="{{ trans('clients.select') }}">
                    <option value="">{{ trans('clients.select') }}</option>
                </select>
            </div>
        </div>
        @error('area_id')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div id="save-btn" class="col-md-2" style="margin: 28px;display: block">
        <button type="button" onclick="add_setting('clients', '{{ $input_id }}')"
            class="btn btn-success">{{ trans('clients.save') }}</button>
    </div>
    <div id="update-btn" class="col-md-2" style="margin: 28px;display: none">
        <button type="button" onclick="update_setting('clients', '{{ $input_id }}')"
            class="btn btn-success">{{ trans('clients.update') }}</button>
    </div>
</div>

<br>
<br>
@if ($clients->count())
    <div class="table-responsive">
        <table id="table1" class="table table-bordered">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th style="width: 5%">{{ trans('clients.m') }}</th>
                    <th style="text-align: center">{{ trans('clients.name') }}</th>
                    <th style="text-align: center">{{ trans('clients.email') }}</th>
                    <th style="text-align: center">{{ trans('clients.governate') }}</th>
                    <th style="width: 20%; text-align: center">{{ trans('clients.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $x = 0; @endphp
                @foreach ($clients as $row)
                    <tr>
                        <td style="text-align: center">{{ $x++ }}</td>
                        <td style="text-align: center">{{ $row->name }}</td>
                        <td style="text-align: center">{{ $row->email }}</td>
                        <td style="text-align: center">{{ $row->governate_data->title }}</td>
                        <td style="text-align: center">
                            <a onclick="edit_setting({{ $row->id }}, '{{ $input_id }}', '{{ $row->name }}', '{{ $row->email }}', '{{ $row->phone }}')"
                                class="btn btn-sm btn-warning edit-btn" title="{{ trans('clients.edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a onclick="delete_setting({{ $row->id }}, 'clients', '{{ $input_id }}')"
                                class="btn btn-sm btn-danger" title="{{ trans('clients.delete') }}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>{{ trans('clients.No data available') }}</p>
@endif

<script type="text/javascript">
    var save_method; // For the save method string
    var table;
    var dt;
</script>
<script>
    "use strict";
    var KTDatatablesServerSide = function() {
        var initDatatable = function() {
            table = $("#table1").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: false,
                order: [
                    [1, 'desc']
                ],
                stateSave: true,
            });
        };

        return {
            init: function() {
                initDatatable();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesServerSide.init();
    });
</script>
<script>
    function get_area(id) {
        $.ajax({
            url: "{{ route('admin.get_area', ['id' => '__id__']) }}".replace('__id__', id),
            type: "get",
            dataType: "html",
            success: function(html) {
                $('#city').html(html);
                $('#city').val(<?= old('city') ?>);
            },
        });
    }
</script>
