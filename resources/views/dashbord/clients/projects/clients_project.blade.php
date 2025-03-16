@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">

                    @include('dashbord.clients.details')
                    @include('dashbord.clients.client_nav')

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">{{trans('payment.pay_dues')}}</div>
                </div>
                <form action="{{ route('admin.company_store_project',$all_data->id) }}" method="post" enctype="multipart/form-data" id="store_form">
                    @csrf
                    <div class="card-body">

                        @include('dashbord.clients.projects.clients_project_form')

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6">
                        <button type="reset"
                                class="btn btn-light btn-active-light-primary me-2">{{trans('payment.discard')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('payment.Save')}}</button>
                    </div>

                </form>
            </div>

            <div class="card" style="margin-top:10px">
                @include('dashbord.clients.projects.clients_project_data')

            </div>

        </div>

    </div>









@endsection

@section('js')


    @notifyJs

@endsection



