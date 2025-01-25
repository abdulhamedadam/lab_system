<form action="{{ route('admin.client_update_company',$company_data->id) }}" method="post" enctype="multipart/form-data" id="store_form">
    @csrf
    <div class="col-md-12 row" style="margin-top: 10px">
        <input type="hidden" name="client_id" id="client_id" value="{{$company_data->client_id}}">
        <div class="col-md-4">
            <label for="first_name" class="form-label">{{ trans('clients.company_code') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="company_code" id="company_code" value="{{$company_data->company_code}}" readonly>
            </div>
            @error('name')
            <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="first_name" class="form-label">{{ trans('clients.name') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$company_data->name) }}">
            </div>
            @error('name')
            <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="last_name" class="form-label">{{ trans('clients.phone') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('phone') !!}</span>
                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone',$company_data->phone) }}">
            </div>
            @error('phone')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12 row" style="margin-top: 10px">
        <div class="col-md-6">
            <label for="email" class="form-label">{{ trans('clients.email') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('email') !!}</span>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email',$company_data->email) }}">
            </div>
            @error('email')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">{{ trans('clients.address1') }}</label>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="basic-addon3">{!! form_icon('address') !!}</span>
                <input type="text" class="form-control" name="address1" id="address1" value="{{ old('address1',$company_data->address1) }}">
            </div>
            @error('email')
            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12 row" style="margin-top: 10px">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="form-group">
                <button type="submit" name="add" value="add" class="btn btn-success btn-flat">
                    <?= trans('employees.SaveButton') ?>
                </button>
            </div>
        </div>
    </div>
</form>
