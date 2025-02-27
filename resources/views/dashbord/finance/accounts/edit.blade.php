@extends('dashbord.layouts.master')

@section('toolbar')

    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('account.create')}}</h1>
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
                    <a href="{{ route('admin.finance.accounts.index') }}"
                       class="text-muted text-hover-primary"> {{trans('Toolbar.account')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{trans('Toolbar.accountCreate')}}
                </li>


            </ul>

        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="d-flex">
                <a href="{{route('admin.finance.accounts.index')}}"
                   class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4">
                    <span class="svg-icon svg-icon-2">
                                   <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                       <path
                                           d="M17.6 4L9.6 12L17.6 20H13.6L6.3 12.7C5.9 12.3 5.9 11.7 6.3 11.3L13.6 4H17.6Z"
                                           fill="currentColor"/>
                                   </svg>
                    </span>

                </a>
            </div>

        </div>


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
              action="{{route('admin.finance.accounts.update',$record['id'])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{trans('account.mainData')}}</h2>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-6">
                                <label class="required form-label">{{trans('account.name')}}
                                    <span class="text-muted fs-7">"{{trans('forms.lable_en')}}"</span>
                                </label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" name="name[en]" class="form-control" placeholder="{{trans('account.name')}}" value="{{old('name[en]',$record['name']['en'])}}"/>
                                </div>
                                @error('name[en]')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="required form-label">{{trans('account.name')}}
                                    <span class="text-muted fs-7">"{{trans('forms.lable_ar')}}"</span>
                                </label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" name="name[ar]"
                                           class="form-control"
                                           placeholder="{{trans('account.name')}}" value="{{old('name[ar]',$record['name']['ar'])}}"/>
                                </div>
                                @error('name[ar]')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="row" style="margin-top: 10px">

                            <div class="col-md-4">
                                <label class="required form-label">{{trans('account.code')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" name="code" id="code"
                                           class="form-control"
                                           placeholder="{{trans('account.code')}}" value="{{old('code',$record['code'])}}"/>
                                </div>
                                @error('name[ar]')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="required form-label">{{trans('account.parent_accounts')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>

                                    <select name="account_id" data-control="select2" class="form-control">
                                        <option value="">Select Account</option>
                                        @foreach ($accounts as $account)
                                            @include('dashbord.finance.accounts.account_option', ['account' => $account, 'prefix' => '','record'=>$record])
                                        @endforeach
                                    </select>

                                </div>
                                @error('parent_id')
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

