@extends('dashbord.layouts.master')
@section('css')
@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{ trans('Toolbar.account_statement') }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                        {{ trans('Toolbar.home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ trans('Toolbar.Payment') }}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ trans('Toolbar.pay_dues') }}
                </li>


            </ul>

        </div>

    </div>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">

                    @include('dashbord.company.company_details')
                    @include('dashbord.company.company_nav')

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">{{trans('payment.pay_dues')}}</div>
                </div>
                <form method="post" action="{{ route('admin.save_payment_pay_dues',$all_data->id) }}" enctype="multipart/form-data" id="paymentForm">
                    @csrf

                    <div class="card-body">

                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <label class="required form-label">{{ trans('company.amount') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                           value="{{ old('amount') }}"/>
                                </div>
                                @error('amount')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 " style="margin-top: 27px">

                                <button type="button" class="btn btn-primary"
                                        onclick="prepare()">{{trans('company.prepare_amount_by_system')}}</button>
                            </div>
                        </div>


                        <div id="prepared_form">

                        </div>
                    </div>
                        <div class="card-footer d-flex justify-content-end py-6">
                            <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">{{trans('payment.discard')}}</button>
                            <button type="submit" class="btn btn-primary">{{trans('payment.Save')}}</button>
                        </div>

                </form>
            </div>


        </div>

    </div>
@endsection


@section('js')
    <script>
        function show_due_details(id) {
            var url = "{{ route('admin.company_due_details', ['id' => $all_data->id, 'due_id' => '__due_id__']) }}"
                .replace('__due_id__', id);
            $.ajax({
                url: "{{ route('admin.company_due_details', ['id' => $all_data->id, 'due_id' => '__due_id__']) }}"
                    .replace('__due_id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#due_deatails').html(html);
                },
                error: function (xhr, status, error) {
                    console.log(url);
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        function prepare() {
            var amount = $('#amount').val();
            if (!amount || amount <= 0) {
                toastr.error('Please enter a valid amount');
                return;
            }
            $.ajax({
                url: "{{ route('admin.company_prepare_amount',$all_data->id) }}",
                type: "GET",
                dataType: "html",
                data:{amount:amount},
                success: function (html) {
                    $('#prepared_form').html(html);
                },
                error: function () {
                    console.log(url);
                    console.error(xhr.responseText);
                }
            });
        }

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            if (document.getElementById('prepared_form').innerHTML.trim() === '') {
                e.preventDefault();
                toastr.error('{{ trans("payment.please_prepare_first") }}');
                return false;
            }

            const requiredFields = ['payment_type', 'received_by', 'paid_date'];
            let isValid = true;

            requiredFields.forEach(field => {
                const element = document.querySelector(`[name="${field}"]`);
                if (!element.value) {
                    element.classList.add('is-invalid');
                    isValid = false;
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                toastr.error('{{ trans("payment.fill_required_fields") }}');
                return false;
            }

            return true;
        });
    </script>


@endsection
