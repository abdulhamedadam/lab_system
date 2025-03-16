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

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    @include('dashbord.payments.dues.details')
                    @include('dashbord.payments.dues.nav')
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">{{trans('payment.pay_dues')}}</div>
                </div>
                <form method="post" action="{{ route('admin.payment.save_pay_dues',$all_data->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        @include('dashbord.payments.dues.pay_form')

                    </div>
                    @if($required_value > 0)
                        <div class="card-footer d-flex justify-content-end py-6">
                            <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">{{trans('payment.discard')}}</button>
                            <button type="submit" class="btn btn-primary">{{trans('payment.Save')}}</button>
                        </div>
                    @endif
                </form>
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



