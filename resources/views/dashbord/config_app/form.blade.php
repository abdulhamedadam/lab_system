@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div class="row col-md-12">
            <div class="col-md-3">
                @include('dashbord.admin.settings.sidebar')
            </div>
            <div class="col-md-9">
                <div id="kt_app_content" class="app-content flex-column-fluid" >
                    <div id="kt_app_content_container" class="" style="padding-top: 20px" >
                        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('settings.app_config') }}</h3>
                            </div>


                            <div class="card-body">
                                <form action="{{route('admin.save_app_config')}}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">{{ trans('settings.soil_prefix') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                            <input type="text" class="form-control" name="soil_prefix" id="soil_prefix" value="{{ old('soil_prefix', $all_data['soil_prefix'] ?? '') }}" >
                                        </div>
                                        @error('soil_prefix')
                                        <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">{{ trans('settings.concrete_prefix') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                            <input type="text" class="form-control" name="concrete_prefix" id="concrete_prefix" value="{{ old('soil_prefix', $all_data['concrete_prefix'] ?? '') }}" >
                                        </div>
                                        @error('concrete_prefix')
                                        <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">{{ trans('settings.road_prefix') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                            <input type="text" class="form-control" name="road_prefix" id="road_prefix" value="{{ old('soil_prefix', $all_data['road_prefix'] ?? '') }}" >
                                        </div>
                                        @error('road_prefix')
                                        <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">{{ trans('settings.number_days_alert_before_sample_expiration') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                            <input type="number" class="form-control" name="number_days_alert_before_sample_expiration" id="number_days_alert_before_sample_expiration" value="{{ old('soil_prefix', $all_data['number_days_alert_before_sample_expiration'] ?? '') }}" >
                                        </div>
                                        @error('road_prefix')
                                        <span class="fv-plugins-message-container" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">
                                            {{ trans('company.save') }}
                                        </button>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection
