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
                <div class="card-title fs-3 fw-bold">{{trans('clients.companies')}}</div>
            </div>

                <div class="card-body">

                    @include('dashbord.clients.company.clients_company_form')

                </div>



        </div>

        <div class="card" style="margin-top:10px">
            @include('dashbord.clients.company.clients_company_data')

        </div>

    </div>

</div>






@endsection

@section('js')


    @notifyJs

@endsection



