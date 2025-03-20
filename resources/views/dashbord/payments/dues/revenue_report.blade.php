@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('toolbar')
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('receipt_voucher.create')}}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                        {{trans('Toolbar.home')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.Payment')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.revenue_report')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>


            </ul>

        </div>

    </div>

@endsection
@section('content')



    <div id="kt_app_content_container" class="app-container container-xxxl">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

            <div class="card-body pt-0">
                <div class="row" style="margin-top:20px">
                    <div class="col-md-3">
                        <label for="first_name" class="form-label">{{ trans('payment.client') }}</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                            <select class="form-select rounded-start-0" onchange="get_company(this.value)"
                                    name="client_id" id="client_id">
                                <option value="">{{trans('clients.select')}}</option>
                                @foreach($clients as $item)
                                    <option
                                        value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('client_id')
                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="talab_end_date" class="form-label">{{ trans('payment.from_date') }}</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                            <input type="date" class="form-control" name="from_date" id="from_date"
                                   value="{{ old('from_date') }}">
                        </div>
                        @error('from_date')
                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="talab_end_date" class="form-label">{{ trans('payment.to_date') }}</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                            <input type="date" class="form-control" name="to_date" id="to_date"
                                   value="{{ old('to_date') }}">
                        </div>
                        @error('to_date')
                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-success" onclick="get_revenue_report()" id="searchButton"
                                style="margin-top: 30px;">
                            {{ trans('payment.search') }}
                        </button>
                    </div>
                </div>

                <div id="result" style="margin-top: 30px">

                </div>
            </div>

        </div>

    </div>

@endsection
@section('js')



    <script>
        function get_revenue_report() {
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var client_id = $('#client_id').val();
            $.ajax({
                url: '{{route('admin.payment.get_revenue_report')}}',
                type: 'get',
                data: {
                    from_date: fromDate,
                    client_id: client_id,
                    to_date: toDate
                },
                success: function (data) {
                    $('#result').html(data);

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);

                }
            });
        }


    </script>
@endsection
