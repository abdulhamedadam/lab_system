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
                    {{ trans('Toolbar.account_statement') }}
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

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-8">

                    <div class="card card-flush  h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-5 d-flex justify-content-between align-items-center">
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">{{ trans('dues.all_dues') }}</h3>
                            </div>

                        </div>


                        <div class="card-body pt-0" style="padding: 10px">
                            <div class="table-responsive">
                                <table id="kt_profile_overview_table"
                                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                    <thead class="fs-7 text-gray-500 text-uppercase">
                                        <tr>

                                            <th>{{ trans('tests.test_code') }}</th>
                                            <th>{{ trans('tests.test_name') }}</th>
                                            <th>{{ trans('tests.test_value') }}</th>
                                            <th>{{ trans('tests.created_at') }}</th>
                                            <th>{{ trans('tests.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody class="fs-6">
                                        @foreach ($dues_data as $record)
                                            <tr>
                                                <td>{{ get_app_config_data(in_array($record->test_data->test_type, ['soil', 'hasa']) ? 'soil_prefix' : $record->test_data->test_type . '_prefix') . $record->test_data->test_code }}
                                                </td>
                                                <td>{{ $record->test_name }}</td>
                                                <td>{{ $record->test_value }}</td>
                                                <td>{{ $record->created_at }}</td>

                                                <td>
                                                    <a onclick="show_due_details({{ $record->id }})"
                                                        class="btn btn-sm btn-light btn-active-light-primary"
                                                        target="_blank">
                                                        {{ trans('tests.view') }}
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
                <div class="col-xl-4">

                    <div class="card card-flush h-md-100">

                        <div class="card-header pt-5 mb-6">

                            <h3 class="card-title align-items-start flex-column">


                                <span class="fs-6 fw-semibold text-gray-500">{{ trans('tests.dues_details') }}</span>

                            </h3>

                        </div>

                        <div class="card-body py-0 px-0" id="due_deatails">

                        </div>

                    </div>

                </div>
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
                success: function(html) {
                    $('#due_deatails').html(html);
                },
                error: function(xhr, status, error) {
                    console.log(url);
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
