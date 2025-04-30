@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.hr'), 'link' => ''],
                  ['label' => trans('Toolbar.deduction'), 'link' => ''],
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ BackButton(route('admin.payroll.index')) }}


        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.payroll','admin.deductions.index',' ')
            @endphp

            <div class="card-body">
                <div class="row" style="margin-top:20px;margin-bottom: 20px">
                    <div class="col-md-4">
                        <div class="mb-10">
                            <label class="required fs-6 fw-semibold mb-2">{{trans('reports.from_date')}}</label>
                            <input
                                class="form-control form-control-solid @error('from_date') is-invalid @enderror"
                                value="{{old('from_date')}}" name="from_date"
                                placeholder="Pick date range" id="from_date"/>
                            <!--end::Input-->
                            @error('from_date')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-10">
                            <label class="required fs-6 fw-semibold mb-2">{{trans('reports.to_date')}}</label>
                            <input
                                class="form-control form-control-solid @error('to_date') is-invalid @enderror"
                                value="{{old('to_date')}}" name="to_date"
                                placeholder="Pick date range" id="to_date"/>
                            <!--end::Input-->
                            @error('to_date')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <button onclick="get_payroll()" class="btn btn-primary">{{trans('reports.Search')}}</button>


                    </div>
                </div>

                <div class="text-center">
                    <span id="loading_spinner" style="display: none; margin-left: 10px;">🔄 {{trans('reports.search')}}...</span>
                </div>

                <div id="report_container">

                </div>
            </div>

        </div>

    </div>



@stop
@section('js')


    <script>
        var KTAppBlogSave = function () {
            const initDaterangepicker = () => {

                $("#from_date").daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 2000,
                        maxYear: parseInt(moment().format("YYYY"), 12)
                    }
                );

                $("#to_date").daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 2000,
                        maxYear: parseInt(moment().format("YYYY"), 12)
                    }
                );
            }


            // Public methods
            return {
                init: function () {
                    initDaterangepicker();
                }
            };
        }();
        KTUtil.onDOMContentLoaded(function () {
            KTAppBlogSave.init();
        });
    </script>

    <script>
        function get_payroll() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (!from_date || !to_date) {
                alert("Please select both From Date and To Date.");
                return;
            }

            // عرض عنصر التحميل وتعطيل الزر
            $('#loading_spinner').show();
            $('#search_btn').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.get_payroll') }}",
                type: 'GET',
                data: {from_date: from_date, to_date: to_date},
                beforeSend: function () {
                    console.log("Fetching report...");
                },
                success: function (response) {
                    console.log(response);
                    $('#report_container').html(response);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching report:", error);
                    alert("An error occurred while fetching the report.");
                },
                complete: function () {
                    // إخفاء عنصر التحميل وإعادة تمكين الزر
                    $('#loading_spinner').hide();
                    $('#search_btn').prop('disabled', false);
                }
            });
        }
    </script>


@endsection

