@extends('dashbord.layouts.master')
@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
            $breadcrumbs = [
                ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                ['label' => trans('Toolbar.tests'), 'link' => ''],
                 ['label' => trans('Toolbar.hasa'), 'link' => ''],
                  ['label' => trans('Toolbar.compaction'), 'link' => ''],
            ];

            PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ BackButton(route('admin.hasa_compaction_soil_test')) }}

        </div>
    </div>

@endsection
@section('content')

    <div id="kt_app_content_container" class="t_container">

        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
            @php
                generateCardHeader('tests.edit_test','admin.test.index',' ')
            @endphp


            <form action="{{ route('admin.hasa_compaction_update_soil_test', [$all_data->id]) }}" method="post" enctype="multipart/form-data" id="edit_form">
                @csrf

                <div class="card-body">
                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="test_code" class="form-label">{{ trans('tests.test_code') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="test_code" id="test_code" value="{{ get_app_config_data('soil_prefix').$all_data->test_code  }}" readonly>
                            </div>
                            @error('test_code')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.client') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="client_id" id="client_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach($clients as $item)
                                        <option value="{{ $item->id }}" {{ $all_data->client_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('client_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="company_id" class="form-label">{{ trans('tests.company') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="company_id" id="company_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach($companies as $item)
                                        <option value="{{ $item->id }}" {{ $all_data->company_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('company_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="project_id" class="form-label">{{ trans('tests.project') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="project_id" id="project_id">
                                    <option value="">{{ trans('tests.select') }}</option>
                                    @foreach($projects as $item)
                                        <option value="{{ $item->id }}" {{ $all_data->project_id == $item->id ? 'selected' : '' }}>{{ $item->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('project_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-12 row" style="margin-top: 10px">

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.wared_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="text" class="form-control" name="wared_number" id="wared_number" value="{{ old('wared_number',$all_data->wared_number) }}">
                            </div>
                            @error('wared_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.wared_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="date" class="form-control" name="wared_date" id="wared_date" value="{{ old('wared_number',$all_data->wared_date) }}">
                            </div>
                            @error('wared_date')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="talab_number" class="form-label">{{ trans('tests.talab_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="number" class="form-control" name="talab_number" id="talab_number" value="{{ $all_data->talab_number }}">
                            </div>
                            @error('talab_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_title" class="form-label">{{ trans('tests.talab_title') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="talab_title" id="talab_title" value="{{ $all_data->talab_title }}">
                            </div>
                            @error('talab_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_image" class="form-label">{{ trans('tests.talab_image') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('image') !!}</span>
                                <input type="file" class="form-control" name="talab_image" id="talab_image">
                            </div>
                            @error('talab_image')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror

                            @if(isset($all_data) && $all_data->talab_image)
                                <div class="mt-2">
                                    <img src="{{ asset('images/' . $all_data->talab_image) }}" alt="Talab Image" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.talab_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="talab_date" id="talab_date" value="{{ $all_data->talab_date }}">
                            </div>
                            @error('talab_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_end_date" class="form-label">{{ trans('tests.talab_end_date') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                <input type="date" class="form-control" name="talab_end_date" id="talab_end_date" value="{{ $all_data->talab_end_date }}">
                            </div>
                            @error('talab_end_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.sample_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="sample_number" id="sample_number" value="{{ old('sample_number',$all_data->sample_number) }}">
                            </div>
                            @error('sample_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="book_number" class="form-label">{{ trans('tests.book_number') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="book_number" id="book_number" value="{{ old('book_number',$all_data->book_number) }}">
                            </div>
                            @error('book_number')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.test_cost') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                <input type="number" class="form-control" name="cost" id="cost" value="{{ old('cost',$all_data->cost) }}">
                            </div>
                            @error('cost')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        @php
                            $test_type=['soil'=>trans('tests.soil'),'hasa'=>trans('tests.hasa')]
                        @endphp
                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.soil_test_type') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="test_type" id="test_type" disabled>
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($test_type as $key=>$value)
                                        <option value="{{$key}}" {{ old('test_type',$all_data->test_type) == $key ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>


                        @php
                            $tests=['compaction'=>trans('tests.compaction'),
                                    'proctor'=>trans('tests.proctor'),
                                     'cbr'=>trans('tests.cbr'),
                                     'plasticity'=>trans('tests.plasticity'),
                                     'salt_gypsum'=>trans('tests.salt_gypsum'),
                                     'salt_organic'=>trans('tests.salt_organic'),
                                     'shear'=>trans('tests.shear'),
                                     'unconfined_compression'=>trans('tests.unconfined_compression'),
                                     'gradual'=>trans('tests.gradual')];
                        @endphp

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.tests') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="sub_test_type" id="sub_test_type" disabled>
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($tests as $key=>$value)
                                        <option value="{{$key}}" {{ old('test_type','compaction') == $key ? 'selected' : '' }}>{{ trans('soil.'.$value)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('test_type')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12 row" style="margin-top: 10px">
                        <div class="col-md-3">
                            <label for="talab_date" class="form-label">{{ trans('tests.authorized_name') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                <input type="text" class="form-control" name="authorized_name" id="authorized_name" value="{{ old('authorized_name',$all_data->authorized_name) }}">
                            </div>
                            @error('authorized_name')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="client_id" class="form-label">{{ trans('tests.monamzig') }}</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                <select class="form-select rounded-start-0" name="monamzig_id" id="monamzig_id" >
                                    <option value="">{{trans('tests.select')}}</option>
                                    @foreach($employees as $item)
                                        <option value="{{$item->id}}" {{ old('monamzig_id',$all_data->monamzig_id) == $item->id ? 'selected' : '' }}>{{$item->first_name.''.$item->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('monamzig_id')
                            <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        {{ trans('tests.update') }}
                    </button>
                </div>
            </form>
        </div>

    </div>












@stop
@section('js')

    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function() {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>




@endsection
