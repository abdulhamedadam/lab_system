@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{trans('complaints.trainers')}}</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted"><a href="{{ route('admin.dashboard') }}"
                                                          class="text-muted text-hover-primary">{{trans('Toolbar.home')}}</a>
                </li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">{{trans('complaints.complaints')}}</li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">{{trans('complaints.complaints')}}</li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">{{trans('complaints.add_complaints')}}</li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex">
                <a class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4"
                   href="{{route('admin.complaints.index')}}">
                {{--                    <i class="bi bi-arrow-clockwise ">{{trans('sub.back')}}</i>--}}
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
        </div>
    </div>

@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm ">
                <div class="card-header">
                    <h3 class="card-title"></i> {{trans('complaints.add_new')}}</h3>

                </div>

                <form id="save_form" method="post" action="{{ route('admin.complaints.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                        <div class="row">
                           
                            <div class="col-md-6">
                                <label class="required form-label">{{trans('complaints.name')}}
                                    (<span
                                    class="text-muted">{{trans('forms.lable_en')}}</span>)</label>
                               
                                <input type="text" name="name_en" id="name_en" class="form-control mb-2"
                                       placeholder="{{trans('complaints.name')}}" value="" required
                                       autocomplete/>
                            </div>
                            <div class="col-md-6">
                                <label class="required form-label">{{trans('complaints.name')}}
                                    (<span
                                    class="text-muted">{{trans('forms.lable_ar')}}</span>)</label>
                                </label>
                                <input type="text" name="name_ar" id="name_ar" class="form-control mb-2"
                                       placeholder="{{trans('complaints.name')}}" value="" required
                                       autocomplete/>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{trans('complaints.date')}}</label>
                                <input
                                    class="form-control form-control-solid @error('date') is-invalid @enderror"
                                    value="" name="date"
                                    placeholder="Pick date rage" id="date"/>
                                @error('date')
                                <div
                                    class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                           
                            <div class="col-md-6">
                                <label class="required form-label">{{ trans('complaints.type') }}</label>
                                <select class="form-select" data-control="select2" data-placeholder="Select an option"
                                        name="type" id="type">
                                        <option value="">{{ trans('complaints.select') }}</option>
                                        <?php
                                        $select_array = array('complaint',
                                            'suggestion')
                                        ?>
                                        @foreach($select_array as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-6">
                                <label class="required form-label">
                        {{ trans('complaints.Submitted_by') }}</label>
                                <select class="form-select" data-control="select2" data-placeholder="Select an option"
                                        name="Submitted_by" id="Submitted_by">
                                    <option value="">{{ trans('complaints.select') }}</option>
                                    <?php
                                    $select_array = array('memeber',
                                        'trainer',
                                        'employee')
                                    
                                    ?>
                                    @foreach($select_array as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">

                        <label for=description class="form-label">{{trans('complaints.Description')}}</label>
                        <span class="text-muted">({{ trans('forms.lable_ar') }})</span>
                        <div class="text-muted fs-7">
                                            <textarea name="description"
                                                      class="form-control form-control form-control-solid"
                                                      rows="2" placeholder="write a message"></textarea></div>



                            </div>





                        </div>
                        
                            <div class="d-flex justify-content-end" style="margin-top: 20px">
                                <button type="submit" id="" class="btn btn-primary">
                                    <span class="indicator-label">{{trans('forms.save_btn')}}</span>
                                    <span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                                </button>
                            </div>



                    </div>


                </form>

            </div>


        </div>
    </div>










@stop
@section('js')




<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
   {!! JsValidator::formRequest('App\Http\Requests\Admin\ComplaintsRequest', '#save_form'); !!}
 
 <script src="{{asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>

    <script>
        var KTAppBlogSave = function () {
            

            const initDaterangepicker = () => {

$("#date").daterangepicker({
singleDatePicker: true,
showDropdowns: true,
minYear: 2000,
maxYear: parseInt(moment().format("YYYY"), 12)
}
);
}
                 
            return {
                init: function () {
                 
                    initDaterangepicker();
                }
            };
        }();
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppBlogSave.init();
        });

    </script>


@endsection
