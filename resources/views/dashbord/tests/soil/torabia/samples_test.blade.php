@extends('dashbord.layouts.master')



@section('toolbar')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        @php
            $title = trans('tests.tests');
         $breadcrumbs = [
                  ['label' => trans('Toolbar.home'), 'link' => route('admin.test.index')],
                  ['label' => trans('Toolbar.tests'), 'link' => ''],
                  ['label' => trans('tests.torabia'), 'link' => ''],
                  ['label' => trans('tests.compaction_test'), 'link' => '']
                  ];

          PageTitle($title, $breadcrumbs);
        @endphp


        <div class="d-flex align-items-center gap-2 gap-lg-3">

            {{ BackButton(route('admin.soil_compaction_soil_test'))}}

        </div>
    </div>

@endsection

@section('content')




    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">

                    @include('dashbord.tests.soil.torabia.details')
                    @include('dashbord.tests.soil.torabia.nav')

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">{{trans('payment.tests')}}</div>
                </div>
                <form action="{{ route('admin.save_compaction_test',$all_data->id) }}" method="post"
                      enctype="multipart/form-data"
                      id="store_form">
                    @csrf
                    <div class="card-body">

                        <div class=" row">


                            <div class="row" style="margin-top: 10px">
                                <input type="hidden" name="soil_compaction_test_id" id="soil_compaction_test_id"
                                       value="{{$compaction_test[0]->id}}">

                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.test_code') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text" class="form-control" name="test_code" id="test_code"
                                               value="{{get_app_config_data('soil_prefix').$all_data->test_code}}"
                                               readonly>
                                    </div>
                                    @error('test_code')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="project_code"
                                           class="form-label">{{ trans('tests.test_carried_date') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="date" class="form-control" name="test_carried_date"
                                               id="test_carried_date"
                                               value="{{old(date('Y-m-d'),$compaction_test[0]->test_carried_date)}}">
                                    </div>
                                    @error('test_carried_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="project_code"
                                           class="form-label">{{ trans('tests.proctor_test_date') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="date" class="form-control" name="proctor_test_date"
                                               id="proctor_test_date"
                                               value="{{old(date('Y-m-d'),$compaction_test[0]->proctor_test_date)}}">
                                    </div>
                                    @error('proctor_test_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="project_code"
                                           class="form-label">{{ trans('tests.sample_collect_date') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="date" class="form-control" name="sample_collect_date"
                                               id="sample_collect_date"
                                               value="{{old(date('Y-m-d'),$compaction_test[0]->sample_collect_date)}}">
                                    </div>
                                    @error('sample_collect_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.location') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text" class="form-control" name="location" id="location"
                                               value="{{old('location',$compaction_test[0]->location)}}">
                                    </div>
                                    @error('location')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="proctor_ref" class="form-label">{{ trans('tests.proctor_ref') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text" class="form-control" name="proctor_ref" id="proctor_ref"
                                               value="{{old('proctor_ref',$compaction_test[0]->proctor_ref)}}">
                                    </div>
                                    @error('proctor_ref')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>


                            <div class=" row" style="margin-top: 10px">

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.test_method') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text" class="form-control" name="test_method" id="test_method"
                                               value="{{old('test_method',$compaction_test[0]->test_method)}}">
                                    </div>
                                    @error('test_method')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.material_desc') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text" class="form-control" name="material_desc" id="material_desc"
                                               value="{{old('material_desc',$compaction_test[0]->material_desc)}}">
                                    </div>
                                    @error('material_desc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mdd') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="number" step="any" class="form-control" name="mdd" id="mdd"
                                               value="{{old('mdd',$compaction_test[0]->mdd)}}">
                                    </div>
                                    @error('mdd')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.moc') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="number" step="any" class="form-control" name="moc" id="moc"
                                               value="{{old('moc',$compaction_test[0]->moc)}}">
                                    </div>
                                    @error('moc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mold_number') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="text"  class="form-control" name="mold_number"
                                               id="mold_number"
                                               value="{{old('mold_number',$compaction_test[0]->mold_number)}}">
                                    </div>
                                    @error('mold_number')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.diameter') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="number" step="any" class="form-control" name="diameter"
                                               id="diameter" value="{{old('diameter',$compaction_test[0]->diameter)}}">
                                    </div>
                                    @error('diameter')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px">


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.height') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="number" step="any" class="form-control" name="height" id="height"
                                               value="{{old('height',$compaction_test[0]->height)}}">
                                    </div>
                                    @error('height')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.volume') }}</label>
                                    <div class="input-group flex-nowrap">

                                        <input type="number" step="any" class="form-control" name="volume" id="volume"
                                               value="{{old('volume',$compaction_test[0]->volume)}}">
                                    </div>
                                    @error('height')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <hr style="border: 2px solid red; width: 100%;margin-top: 20px ;margin-bottom: 20px">
                            <div class="col-md-12 row" style="margin-top: 10px; direction: ltr;">
                                <table id="table" class="example table table-bordered responsive nowrap text-center"
                                       cellspacing="0" width="100%" style="direction: ltr;">
                                    <thead>
                                    <tr class="greentd" style="background-color: darkblue;color: white">
                                        <th>{{trans('tests.point_number') }}</th>
                                        @if(isset($compaction_test) || !empty($compaction_test ) || $compaction_test->isEmpty() )
                                            @foreach ($compaction_test[0]->compaction_test_details as $test)
                                                <th>{{$test->point}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $table_data = [
                                            1 => ['name' => 'point_location', 'type' => 'text', 'readonly' => false, 'background' => '', 'value' => ''],
                                            2 => ['name' => 'layer_number', 'type' => 'text', 'readonly' => false, 'background' => '', 'value' => ''],
                                            3 => ['name' => 'can_number', 'type' => 'text', 'readonly' => false, 'background' => '', 'value' => ''],
                                            4 => ['name' => 'wt_wet_soil_can', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            5 => ['name' => 'wt_dry_soil_can', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            6 => ['name' => 'wt_moisture', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080 ', 'value' => ''],
                                            7 => ['name' => 'wt_can', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            8 => ['name' => 'wt_dry_soil', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080 ', 'value' => ''],
                                            9 => ['name' => 'moisture_content', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            10 => ['name' => 'wt_wet_soil_gm', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            11 => ['name' => 'mulod_volume', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            12 => ['name' => 'wet_density', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            13 => ['name' => 'dry_density', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            14 => ['name' => 'max_dry_density', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            15 => ['name' => 'compaction', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            16 => ['name' => 'req_compaction', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            17 => ['name' => 'evaluation', 'type' => 'hidden', 'readonly' => true, 'background' => '', 'value' => ''],
                                        ];
                                    @endphp

                                    @foreach ($table_data as $key => $value)

                                        {{-- إضافة العنوان بعد الصف الرابع --}}
                                        @if ($key == 4)
                                            <tr>
                                                <td colspan="{{ count($compaction_test[0]->compaction_test_details) + 1 }}"
                                                    style="background-color: darkblue;color: white">
                                                    Moisture Determination
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($key == 13)
                                            <tr>
                                                <td colspan="{{ count($compaction_test[0]->compaction_test_details) + 1 }}"
                                                    style="background-color: darkblue;color: white">
                                                    Density Determination
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td style="background-color: #1C3D6E; color:white">
                                                {{ trans('tests.' . $value['name']) }}
                                            </td>
                                            @foreach ($compaction_test[0]->compaction_test_details as $test)
                                                <td style="background-color: {{ $value['background'] }}">
                                                    <span id="span-{{ $value['name'] }}-{{ $test->point }}"></span>
                                                    <input style="text-align-last: center"
                                                           type="{{ $value['type'] }}"
                                                           value="{{ old($value['name'] . '-' . $test->point, data_get($test, $value['name'], '')) }}"
                                                           class="form-control"
                                                           name="{{ $value['name'] }}-{{ $test->point }}"
                                                           id="{{ $value['name'] }}-{{ $test->point }}"
                                                           @if($value['readonly']) readonly @endif>
                                                </td>
                                            @endforeach
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <div class="col-md-2">
                                        <label for="project_code" class="form-label">{{ trans('tests.sader_num') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="number" step="any" class="form-control" name="sader_num" id="sader_num" value="">
                                        </div>
                                        @error('sader_num')
                                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2">
                                        <label for="project_code" class="form-label">{{ trans('tests.sader_date') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="date" class="form-control" name="sader_date" id="sader_date" value="">
                                        </div>
                                        @error('sader_date')
                                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="margin-top: 27px;margin-right: 20px">
                                        <a href="{{route('admin.soil_sample_report_details',$all_data->id)}}"
                                           class="btn-primary btn "> <?= trans('tests.PrintButton') ?></a>
                                        <button type="submit" class="btn btn-success"
                                                style="margin-right: 10px;margin-left: 10px">{{trans('payment.Save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>




                </form>

            </div>


        </div>

    </div>




@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $('#sader_date').on('change', function() {
                var selectedDate = $(this).val();
                var currentYear = new Date().getFullYear();

                if (selectedDate) {
                    $.ajax({
                        url: "{{ route('admin.check_sader_date') }}",
                        method: 'GET',
                        data: {
                            date: selectedDate,
                            year: currentYear
                        },
                        success: function(response) {
                            if (response.exists) {

                                var numbers = Array.isArray(response.next_number) ? response.next_number : [];

                                var numbersOptions = '<option value="">Select Number</option>'; // Default placeholder
                                numbers.forEach(function(number) {
                                    numbersOptions += '<option value="'+number+'">'+number+'</option>';
                                });

                                $('#sader_num').replaceWith(`
                            <select class="form-control" name="sader_num" id="sader_num">
                                ${numbersOptions}
                            </select>
                        `);
                            } else {
                                var nextNumber = response.next_number;
                                console.log('nextNumber =', nextNumber);

                                $('#sader_num').replaceWith(`
                            <input type="number" step="any" class="form-control" name="sader_num" id="sader_num" value="${nextNumber}">
                        `);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            function calcaulate_volume() {
                var diameter = parseFloat($('#diameter').val()) || 0;
                var height = parseFloat($('#height').val()) || 0;
                var volume = 3.14 * (diameter * diameter) * (height / 4);
                $('#volume').val(volume.toFixed(3));
            }

            function calculateValues(point) {
                var volume = parseFloat($('#volume').val()) || 0;
                $('#mulod_volume-' + point).val(volume.toFixed(2));
                $('#span-mulod_volume-' + point).text(volume.toFixed(2));
                var wt_wet_soil_can = parseFloat($('#wt_wet_soil_can-' + point).val()) || 0;
                var wt_dry_soil_can = parseFloat($('#wt_dry_soil_can-' + point).val()) || 0;
                var wt_can = parseFloat($('#wt_can-' + point).val()) || 0;
                var wt_moisture = wt_wet_soil_can - wt_dry_soil_can;
                $('#wt_moisture-' + point).val(wt_moisture.toFixed(2));
                $('#span-wt_moisture-' + point).text(wt_moisture.toFixed(2));
                var wt_dry_soil = wt_dry_soil_can - wt_can;
                var moisture_content = (wt_moisture * 100) / wt_dry_soil;
                $('#wt_dry_soil-' + point).val(wt_dry_soil.toFixed(2));
                $('#span-wt_dry_soil-' + point).text(wt_dry_soil.toFixed(2));
                $('#span-moisture_content-' + point).text(moisture_content.toFixed(2));
                $('#moisture_content-' + point).val(moisture_content.toFixed(2));
                var wt_wet_soil_gm = parseFloat($('#wt_wet_soil_gm-' + point).val()) || 0;
                var wet_density = wt_wet_soil_gm / volume;
                var dry_density = wet_density / (1 + moisture_content / 100);
                var mdd = parseFloat($('#mdd').val()) || 0;
                var compaction = (dry_density * 100) / mdd;
                $('#wet_density-' + point).val(wet_density.toFixed(3));
                $('#span-wet_density-' + point).text(wet_density.toFixed(3));
                $('#dry_density-' + point).val(dry_density.toFixed(3));
                $('#span-dry_density-' + point).text(dry_density.toFixed(3));
                $('#max_dry_density-' + point).val(mdd.toFixed(3));
                $('#span-max_dry_density-' + point).text(mdd.toFixed(3));
                $('#compaction-' + point).val(compaction.toFixed(3));
                $('#span-compaction-' + point).text(compaction.toFixed(3));
                var req_compaction = parseFloat($('#req_compaction-' + point).val()) || 0;
                var evaluation = compaction > req_compaction ? 'pass' : 'failed';
                $('#evaluation-' + point).val(evaluation);
                $('#span-evaluation-' + point).text(evaluation);
                var cell = $('#evaluation-' + point).closest('td');
                if (evaluation === 'pass') {
                    cell.css({'background-color': '#d4edda', 'color': '#155724', 'font-weight': 'bold'}); // Light green
                } else {
                    cell.css({'background-color': '#f8d7da', 'color': '#721c24', 'font-weight': 'bold'}); // Light red
                }
            }

            @foreach ($compaction_test[0]->compaction_test_details as $test)
            $('#wt_wet_soil_can-{{ $test->point }}, #wt_dry_soil_can-{{ $test->point }}, #wt_can-{{ $test->point }}, #wt_wet_soil_gm-{{ $test->point }}, #req_compaction-{{ $test->point }}').on('keyup', function () {
                calculateValues('{{ $test->point }}');
            });

            calculateValues('{{ $test->point }}');
            @endforeach

            $('#diameter, #height').on('keyup', function () {
                calcaulate_volume();
            });

            calcaulate_volume();
        });

    </script>
    @notifyJs

@endsection



