
@extends('dashbord.layouts.master')
@section('css')
@endsection
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{trans('Toolbar.account_statement')}}</h1>

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
                    @include('dashbord.admin.employees.employee_details')
                    @include('dashbord.admin.employees.employee_nav')

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">{{trans('employee.salaries')}}</div>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.save_employee_salary',$all_data->id)}}" method="POST" id="salary_form">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label class="form-label">{{trans('employee.basic_salary')}}</label>
                                <input type="number" step="0.01" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror"
                                       value="{{ old('basic_salary', optional($all_data->employee_salary)->basic_salary ) }}">
                                @error('basic_salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">{{trans('employee.housing_allowance')}}</label>
                                <input type="number" step="0.01" name="housing_allowance" class="form-control @error('housing_allowance') is-invalid @enderror"
                                       value="{{ old('housing_allowance', optional($all_data->employee_salary)->housing_allowance ?? '') }}">
                                @error('housing_allowance')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">{{trans('employee.transportation_allowance')}}</label>
                                <input type="number" step="0.01" name="transportation_allowance" class="form-control @error('transportation_allowance') is-invalid @enderror"
                                       value="{{ old('transportation_allowance', optional($all_data->employee_salary)->transportation_allowance ?? '') }}">
                                @error('transportation_allowance')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">{{trans('employee.other_allowances')}}</label>
                                <input type="number" step="0.01" name="other_allowances" class="form-control @error('other_allowances') is-invalid @enderror"
                                       value="{{ old('other_allowances', optional($all_data->employee_salary)->other_allowances ?? '') }}">
                                @error('other_allowances')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{trans('employee.total_salary')}}</label>
                                <input type="number" step="0.01" id="total_salary" class="form-control" readonly
                                       value="{{ old('basic_salary', optional($all_data->employee_salary)->basic_salary ?? 0) + old('housing_allowance', optional($all_data->employee_salary)->housing_allowance ?? 0) + old('transportation_allowance', optional($all_data->employee_salary)->transportation_allowance ?? 0) + old('other_allowances', optional($all_data->employee_salary)->other_allowances ?? 0) }}">
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('employee.save_salary')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>




            </div>

            <div class="card" style="margin-top:10px">

            </div>

        </div>

    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {

            function calculateTotalSalary() {
                let basicSalary = parseFloat($('input[name="basic_salary"]').val()) || 0;
                let housingAllowance = parseFloat($('input[name="housing_allowance"]').val()) || 0;
                let transportationAllowance = parseFloat($('input[name="transportation_allowance"]').val()) || 0;
                let otherAllowances = parseFloat($('input[name="other_allowances"]').val()) || 0;

                let total = basicSalary + housingAllowance + transportationAllowance + otherAllowances;

                $('#total_salary').val(total.toFixed(2));
            }
            $('input[name="basic_salary"], input[name="housing_allowance"], input[name="transportation_allowance"], input[name="other_allowances"]').on('input', function() {
                calculateTotalSalary();
            });
            calculateTotalSalary();
        });
    </script>
@endsection

