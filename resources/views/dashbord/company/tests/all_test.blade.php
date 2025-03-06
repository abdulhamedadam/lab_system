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


            <div class="card card-flush mt-6 mt-xl-9">
                <!--begin::Card header-->
                <div class="card-header mt-5 d-flex justify-content-between align-items-center">
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">{{trans('company.tests_cost')}}</h3>
                        @php
                            $cost = $tests_data->sum('cost');
                        @endphp
                        <div class="fs-2 text-gray-500">
            <span class="badge bg-light-success text-danger">
                Total tests cost : ${{ number_format($cost, 2) }}
            </span>
                        </div>
                    </div>

                </div>


                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="kt_profile_overview_table"
                               class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                            <thead class="fs-7 text-gray-500 text-uppercase">
                            <tr>
                                <th></th>
                                {{trans('tests.code')}}</th>
                                <th>{{trans('tests.client')}}</th>
                                <th>{{trans('tests.project')}}</th>
                                <th>{{trans('tests.cost')}}</th>
                                <th>{{trans('tests.talab_image')}}</th>
                                <th>{{trans('tests.talab_title')}}</th>
                                <th>{{trans('tests.talab_date')}}</th>
                                <th>{{trans('tests.wared_number')}}</th>
                                <th>{{trans('tests.book_number')}}</th>
                                <th>{{trans('tests.status')}}</th>
                                <th>{{trans('tests.action')}}</th>

                            </tr>
                            </thead>
                            <tbody class="fs-6">
                            @foreach($tests_data as $test)
                                <tr>
                                    <td>{{'INV-'.$test->code}}</td>
                                    <td>{{optional($test->client)->name}}</td>
                                    <td>{{optional($test->project)->project_name}}</td>
                                    <td>{{$test->cost}}</td>
                                    <td>{{$test->talab_image}}</td>
                                    <td>{{$test->talab_title}}</td>
                                    <td>{{$test->talab_date}}</td>
                                    <td>{{$test->wared_number}}</td>
                                    <td>{{$test->book_number}}</td>
                                    <td>{{$test->status}}</td>
                                    <td>
                                        <a href="#"
                                           class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                                            {{trans('tests.view')}}
                                        </a>
                                    </td>

                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Card body-->
            </div>


        </div>

    </div>
@endsection


@section('js')

@endsection
