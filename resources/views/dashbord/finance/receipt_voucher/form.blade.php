@extends('dashbord.layouts.master')

@section('toolbar')

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
                    {{trans('Toolbar.finance')}}
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.finance.Receipt_Voucher.index') }}"
                       class="text-muted text-hover-primary"> {{trans('Toolbar.Receipt_Voucher')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.CreateReceipt_voucher')}}
                </li>


            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="d-flex">
                <a href="{{route('admin.finance.Receipt_Voucher.index')}}"
                   class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4">

                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/arrows/arr054.svg-->
                    <span class="svg-icon svg-icon-2">
                                   <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                       <path
                                           d="M17.6 4L9.6 12L17.6 20H13.6L6.3 12.7C5.9 12.3 5.9 11.7 6.3 11.3L13.6 4H17.6Z"
                                           fill="currentColor"/>
                                   </svg>
                                </span>
                    <!--end::Svg Icon-->
                </a>
            </div>
            <!--end::Filter menu-->
            <!--begin::Secondary button-->
            <!--end::Secondary button-->
            <!--begin::Primary button-->
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->

    </div>

@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-xxxl">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="StorForm" class="form d-flex flex-column flex-lg-row "
              action="{{route('admin.finance.Receipt_Voucher.store')}}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{trans('account.mainData')}}</h2>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-4">
                                <label class="required form-label">{{trans('receipt_voucher.receipt_number')}}
                                </label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" name="num" class="form-control" placeholder="{{trans('num')}}" value="{{old('num')}}"/>
                                </div>
                                @error('name[en]')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="required form-label">{{trans('receipt_voucher.date')}}
                                </label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="date" name="date_at" class="form-control" placeholder="{{trans('date_at')}}" value="{{old('date_at')}}"/>
                                </div>
                                @error('date_at')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="required form-label">{{trans('account.client_account')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>

                                    <select name="from_account" data-control="select2" class="form-control">
                                        <option value="">Select Account</option>
                                        @foreach ($accounts as $account)
                                            @include('dashbord.finance.accounts.account_option', ['account' => $account, 'prefix' => '','record'=>['parent_id'=>'']])
                                        @endforeach
                                    </select>

                                </div>
                                @error('from_account')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>




                        <div class="row" style="margin-top: 10px">

                            <div class="col-md-4">
                                <label class="required form-label">{{trans('account.amount')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="number" step="any" name="amount" id="amount"
                                           class="form-control"
                                           placeholder="" value="{{old('amount')}}"/>
                                </div>
                                @error('amount')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="required form-label">{{trans('account.spent_to')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>

                                    <select name="to_account" data-control="select2" class="form-control">
                                        <option value="">Select Account</option>
                                        @foreach ($accounts as $account)
                                            @include('dashbord.finance.accounts.account_option', ['account' => $account, 'prefix' => '','record'=>['parent_id'=>'']])
                                        @endforeach
                                    </select>

                                </div>
                                @error('parent_id')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>





                        </div>


                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <label class="required form-label">{{trans('receipt_voucher.notes')}}
                                </label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" name="notes" class="form-control" placeholder="{{trans('notes')}}" value="{{old('notes')}}"/>
                                </div>
                                @error('notes')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            {{ trans('tests.save') }}
                        </button>
                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::General options-->



            </div>
            <!--end::Main column-->
        </form>
    </div>

@endsection
@section('js')
    <!--begin::Vendors Javascript(used for this page only)-->



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


    <script>
        var KTAppaccountSave = function () {


            // Public methods
            return {
                init: function () {
                    // Init forms
                }
            };
        }();
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppaccountSave.init();
        });
    </script>
@endsection

