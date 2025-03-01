@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('toolbar')
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('dues.pay_dues')}}</h1>
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
                    {{trans('Toolbar.pay_dues')}}
                </li>


            </ul>

        </div>

    </div>

@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{trans('dues.pay_dues')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            @include('dashbord.payments.dues.pay_form')


                        </div>
                        <div class="col-md-4">
                            @include('dashbord.payments.dues.details')

                        </div>
                        @include('dashbord.payments.dues.pay_data')
                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>









@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('input[name="value"]').on('keyup', function () {
                let requiredValue = parseFloat($('input[name="required_value"]').val()) || 0;
                let value = parseFloat($(this).val()) || 0;
                let remain = requiredValue - value;

                if (remain < 0) {
                    alert("القيمة المتبقية لا يمكن أن تكون سالبة!");
                    remain = 0;
                    $('input[name="value"]').val(remain);
                }

                $('input[name="remain"]').val(remain);
            });
        });
    </script>





    @notifyJs

@endsection



