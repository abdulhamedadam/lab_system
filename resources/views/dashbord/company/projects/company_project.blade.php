@extends('dashbord.layouts.master')
@section('css')
@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('Toolbar.account_statement')}}</h1>
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
                    {{trans('Toolbar.account_statement')}}
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
                <form action="{{ route('admin.company_store_project',$all_data->id) }}" method="post" enctype="multipart/form-data" id="store_form">
                    @csrf
                    <div class="card-body">

                        @include('dashbord.company.projects.company_project_form')

                    </div>

                        <div class="card-footer d-flex justify-content-end py-6">
                            <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">{{trans('payment.discard')}}</button>
                            <button type="submit" class="btn btn-primary">{{trans('payment.Save')}}</button>
                        </div>

                </form>
            </div>

            <div class="card" style="margin-top:10px">
                @include('dashbord.company.projects.company_project_data')
            </div>

        </div>

    </div>
@endsection


@section('js')

@endsection
