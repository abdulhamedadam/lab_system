@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.hr'), 'link' => ''],
                  ['label' => trans('Toolbar.add_loans'), 'link' => ''],
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{ BackButton(route('admin.loans.index')) }}


        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.add_loan','admin.loans.index',' ')
            @endphp


            <form action="{{ route('admin.loans.update',$loan->id) }}" method="post" enctype="multipart/form-data" id="store_form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="mb-10 fv-row col">
                            <!--begin::Label-->
                            <label class="required form-label">{{trans('loan.Employee_ID')}}

                            </label>
                            <!--end::Label-->

                            <select name="emp_id" id="emp_id"
                                    class="form-select @error('emp_id') is-invalid @enderror"
                                    data-control="select2"
                                    data-allow-clear="true"
                                    data-placeholder="{{trans('maindata.Select')}}">
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}" @if($emp->id == $loan->emp_id) selected @endif>{{ $emp->first_name.' '.$emp->last_name .'( code-'.$emp->emp_code.')' }}</option>
                                @endforeach

                            </select>

                            @error('emp_id')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>

                        <div class="mb-10 fv-row col">

                            <label class="required form-label">{{trans('loan.loan_type')}}

                            </label>


                            <select name="loan_type" id="loan_type"
                                    class="form-select @error('loan_type') is-invalid @enderror"
                                    data-control="select" onchange=""
                                    data-allow-clear="true"
                                    data-placeholder="{{trans('maindata.Select')}}">
                                <?php
                                $types = array('loan'=>'common.loan')
                                ?>

                                @foreach($types as $index=>$value)
                                    <option value="{{ $index }}">{{ $index }}</option>
                                @endforeach
                            </select>

                            @error('e')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="mb-10 fv-row col">
                            <!--begin::Label-->
                            <label class="required form-label">{{trans('loan.value')}}

                            </label>

                            <input type="text" name="value" id="value" value="{{old('value',$loan->value)}}"

                                   class="form-control mb-2  @error('value') is-invalid @enderror"
                                   placeholder="value"/>
                            <!--end::Input-->
                            @error('value')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>


                    </div>
                    <div class="row">
                        <div class="mb-10 fv-row col">

                            <label
                                class="required fs-6 fw-semibold mb-2">{{trans('loan.date_loan')}}</label>

                            <input type="date"
                                   class="form-control form-control-solid @error('date_loan') is-invalid @enderror"
                                   name="date_loan"
                                   placeholder="Pick date rage" id="date_loan" value="{{old('date_loan',$loan->date_loan)}}"/>

                            @error('date_loan')
                            <div
                                class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="mb-10 fv-row col">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-semibold mb-2">{{trans('loan.date_deductions')}}</label>
                            <input type="date" name="date_deductions" class="form-control form-control-solid @error('date_deductions') is-invalid  @enderror" value="{{old('date_deductions',$loan->date_deductions)}}"/>

                            @error('date_deductions')
                            <div
                                class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="mb-10 fv-row col">
                            <!--begin::Label-->
                            <label class="required form-label">{{trans('loan.installments_num')}}

                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="installments_num" id="installments_num" value="{{old('installments_num',$loan->installments_num)}}"

                                   class="form-control mb-2  @error('value') is-invalid @enderror"
                                   placeholder="installments_num"/>
                            <!--end::Input-->
                            @error('installments_num')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>

                    </div>
                    <div class="row">

                        <!--begin::Input group-->
                        <div class="row">
                            <div class="mb-10 fv-row col">
                                <!--begin::Label-->
                                <label class="form-label">{{trans('loan.Reason')}}
                                </label>

                                <textarea class="form-control @error('reason') is-invalid @enderror"
                                          data-kt-autosize="true"
                                          id="reason" name="reason">{{old('reason',$loan->reason)}}</textarea>
                                @error('reason')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->


                        </div>

                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ trans('tests.save') }}
                    </button>
                </div>
            </form>
        </div>

    </div>



    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">{{ trans('clients.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="client_name" class="form-label">{{ trans('clients.name') }}</label>
                        <input type="text" class="form-control" id="client_name" name="client_name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" onclick="saveClient()" class="btn btn-primary"
                            id="saveClient">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyModalLabel">{{ trans('companies.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="company_name" class="form-label">{{ trans('companies.name') }}</label>
                        <input type="text" class="form-control" id="company_name" name="company_name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" class="btn btn-primary" onclick="saveCompany()"
                            id="saveCompany">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">{{ trans('projects.add_new') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="project_name" class="form-label">{{ trans('projects.name') }}</label>
                        <input type="text" class="form-control" id="project_name" name="project_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="button" class="btn btn-primary" onclick="saveProject()"
                            id="saveProject">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>



@stop
@section('js')


@endsection

