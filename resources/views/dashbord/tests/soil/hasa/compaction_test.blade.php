@extends('dashbord.layouts.master')
@section('css')
    <style>
        /* General Table Styling */
        #table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header Row */
        #table thead tr {
            background-color: #1C3D6E; /* Deep Blue */
            color: white;
            font-weight: bold;
            text-align: center;
        }

        /* Header Cells */
        #table thead th {
            padding: 12px;
            text-transform: uppercase;
        }

        /* Alternating Rows */
        #table tbody tr:nth-child(even) {
            background-color: #F2F4F8; /* Light Gray */
        }

        #table tbody tr:nth-child(odd) {
            background-color: #ffffff; /* White */
        }

        /* Table Borders */
        #table td, #table th {
            padding: 10px;
            border-bottom: 1px solid #E0E0E0;
            text-align: center;
        }

        /* Section Headers */
        #table tbody tr td[colspan] {
            background-color: #1C3D6E;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 12px;
        }

        /* Readonly Fields */
        #table input[readonly] {
            background-color: #008080 !important; /* Teal */
            color: white;
            font-weight: bold;
            border: none;
        }

        /* Input Fields */
        #table input {
            width: 90%;
            padding: 6px;
            text-align: center;
            border: 1px solid #B0B0B0;
            border-radius: 4px;
        }

        /* Row Hover Effect */
        #table tbody tr:hover {
            background-color: #DCE3F1; /* Soft Blue */
            transition: 0.3s;
        }

        /* Rounded Borders */
        #table td:first-child, #table th:first-child {
            border-left: 0;
            border-radius: 10px 0 0 10px;
        }

        #table td:last-child, #table th:last-child {
            border-right: 0;
            border-radius: 0 10px 10px 0;
        }

    </style>
    @notifyCss
@endsection
@section('content')

    @include('dashbord.tests.nav')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{trans('tests.samples_test')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">
                    {{-- <div class="col-md-12">
                        @include('dashbord.tests.details')

                    </div> --}}
                    <div class="col-md-12 row">

                        <form action="{{ route('admin.save_hasa_compaction_test',$all_data->id) }}" method="post" enctype="multipart/form-data"
                              id="store_form">
                            @csrf
                            <div class="col-md-12 row" style="margin-top: 10px">
                                <input type="hidden" name="hasa_compaction_test_id" id="hasa_compaction_test_id" value="{{$compaction_test[0]->id}}">

                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.test_code') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="test_code" id="test_code"
                                               value="{{get_app_config_data('soil_prefix').$all_data->test_code}}" readonly>
                                    </div>
                                    @error('test_code')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.test_carried_date') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                        <input type="date" class="form-control" name="test_carried_date" id="test_carried_date" value="{{old(date('Y-m-d'),$compaction_test[0]->test_carried_date)}}">
                                    </div>
                                    @error('test_carried_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.proctor_test_date') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                        <input type="date" class="form-control" name="proctor_test_date" id="proctor_test_date" value="{{old(date('Y-m-d'),$compaction_test[0]->proctor_test_date)}}">
                                    </div>
                                    @error('proctor_test_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.sample_collect_date') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                        <input type="date" class="form-control" name="sample_collect_date" id="sample_collect_date" value="{{old(date('Y-m-d'),$compaction_test[0]->sample_collect_date)}}">
                                    </div>
                                    @error('sample_collect_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.location') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="location" id="location" value="{{old('location',$compaction_test[0]->location)}}">
                                    </div>
                                    @error('location')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="proctor_ref" class="form-label">{{ trans('tests.proctor_ref') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="proctor_ref" id="proctor_ref" value="{{old('proctor_ref',$compaction_test[0]->proctor_ref)}}">
                                    </div>
                                    @error('proctor_ref')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>




                            </div>
                            <div class="col-md-12 row" style="margin-top: 10px">

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.test_method') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="test_method" id="test_method" value="{{old('test_method',$compaction_test[0]->test_method)}}">
                                    </div>
                                    @error('test_method')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.material_desc') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="material_desc" id="material_desc" value="{{old('material_desc',$compaction_test[0]->material_desc)}}">
                                    </div>
                                    @error('material_desc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mdd') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="mdd" id="mdd" value="{{old('mdd',$compaction_test[0]->mdd)}}">
                                    </div>
                                    @error('mdd')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.moc') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="moc" id="moc" value="{{old('moc',$compaction_test[0]->moc)}}">
                                    </div>
                                    @error('moc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>




                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.diameter') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="diameter" id="diameter" value="{{old('diameter',$compaction_test[0]->diameter)}}">
                                    </div>
                                    @error('diameter')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.height') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="height" id="height" value="{{old('height',$compaction_test[0]->height)}}">
                                    </div>
                                    @error('height')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>




                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px">

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mass_mold_sand1') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="mass_mold_sand1" id="mass_mold_sand1" value="{{old('mass_mold_sand1',$compaction_test[0]->mass_mold_sand1)}}">
                                    </div>
                                    @error('mass_mold_sand1')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mass_mold_sand2') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="mass_mold_sand2" id="mass_mold_sand2" value="{{old('mass_mold_sand2',$compaction_test[0]->mass_mold_sand2)}}">
                                    </div>
                                    @error('mass_mold_sand2')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mass_empty_mold') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number"  step="any"  class="form-control" name="mass_empty_sand" id="mass_empty_sand" value="{{old('mass_empty_sand',$compaction_test[0]->mass_empty_sand)}}">
                                    </div>
                                    @error('mass_empty_sand')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.unit_wt_sand1') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="unit_wt_sand1" id="unit_wt_sand1" value="{{old('unit_wt_sand1',$compaction_test[0]->unit_wt_sand1)}}">
                                    </div>
                                    @error('unit_wt_sand1')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.unit_wt_sand2') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="unit_wt_sand2" id="unit_wt_sand2" value="{{old('unit_wt_sand2',$compaction_test[0]->unit_wt_sand2)}}">
                                    </div>
                                    @error('unit_wt_sand2')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.avg_unit_wt_sand') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="avg_unit_wt_sand" id="avg_unit_wt_sand" value="{{old('avg_unit_wt_sand',$compaction_test[0]->avg_unit_wt_sand)}}">
                                    </div>
                                    @error('avg_unit_wt_sand')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px">


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.wt_sand_cone') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="any"  class="form-control" name="wt_sand_cone" id="wt_sand_cone" value="{{old('wt_sand_cone',$compaction_test[0]->wt_sand_cone)}}">
                                    </div>
                                    @error('wt_sand_cone')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px; direction: ltr;">
                                <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0" width="70%" style="direction: ltr;">
                                    <thead>
                                    <tr class="greentd" >
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

                                            10 => ['name' => 'wt_wet_soil', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            11 => ['name' => 'wt_bottle_sand_before', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            12 => ['name' => 'wt_bottle_sand_after', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            13 => ['name' => 'wt_sand_used', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            14 => ['name' => 'wt_sand_cone', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            15 => ['name' => 'wt_sand_fill_hole', 'type' => 'hidden', 'readonly' => true, 'background' => '#008080', 'value' => ''],
                                            16 => ['name' => 'unit_wt_sand', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            17 => ['name' => 'hole_volume', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            18 => ['name' => 'wet_density', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            19 => ['name' => 'dry_density', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            20 => ['name' => 'max_dry_density', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            21 => ['name' => 'compaction', 'type' => 'hidden', 'readonly' => false, 'background' => '#008080', 'value' => ''],
                                            22 => ['name' => 'req_compaction', 'type' => 'number', 'readonly' => false, 'background' => '', 'value' => ''],
                                            23 => ['name' => 'evaluation', 'type' => 'hidden', 'readonly' => false, 'background' => '', 'value' => ''],
                                        ];
                                    @endphp

                                    @foreach ($table_data as $key => $value)

                                        {{-- إضافة العنوان بعد الصف الرابع --}}
                                        @if ($key == 4)
                                            <tr>
                                                <td colspan="{{ count($compaction_test[0]->compaction_test_details) + 1 }}"
                                                    style="">
                                                    Moisture Determination
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($key == 10)
                                            <tr>
                                                <td colspan="{{ count($compaction_test[0]->compaction_test_details) + 1 }}"
                                                    style="">
                                                    Density Determination
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td style="background-color: #1C3D6E; color:white">
                                                {{ trans('tests.' . $value['name']) }}
                                            </td>
                                            @foreach ($compaction_test[0]->compaction_test_details as $test)
                                                <td style="background-color: {{ $value['background'] }}" >
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
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                            <input type="number" step="any" class="form-control" name="sader_num" id="sader_num" value="{{old('sader_num',$compaction_test[0]->sader_num ?? $sader_num)}}">
                                        </div>
                                        @error('sader_num')
                                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2">
                                        <label for="project_code" class="form-label">{{ trans('tests.sader_date') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                            <input type="date" class="form-control" name="sader_date" id="sader_date" value="{{old(date('Y-m-d'),$compaction_test[0]->sader_date ??date('Y-m-d') )}}">
                                        </div>
                                        @error('sader_date')
                                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group" style="margin-top: 27px;margin-right: 20px">
                                        <button type="submit" class="btn btn-success btn-flat">
                                            <?= trans('company.SaveButton') ?>
                                        </button>
                                        <a href="{{route('admin.hasa_compaction_test_details',$all_data->id)}}" class="btn-primary btn "> <?= trans('tests.PrintButton') ?></a>
                                    </div>



                                </div>
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

    <script>
        $(document).ready(function() {
            function calcaulate_volume() {
                var diameter       = parseFloat($('#diameter').val()) || 0;
                var height         = parseFloat($('#height').val()) || 0;
                var mass_mold_sand1 = parseFloat($('#mass_mold_sand1').val()) || 0;
                var mass_mold_sand2 = parseFloat($('#mass_mold_sand2').val()) || 0;
                var mass_empty_sand = parseFloat($('#mass_empty_sand').val()) || 0;
                var unit_wt_sand1 = (mass_mold_sand1-mass_empty_sand)/(3.14*diameter*diameter*height/4);
                var unit_wt_sand2 = (mass_mold_sand2-mass_empty_sand)/(3.14*diameter*diameter*height/4);
                var avg_unit_wt_sand=(unit_wt_sand1+unit_wt_sand2)/2

                $('#unit_wt_sand1').val(unit_wt_sand1.toFixed(3));
                $('#unit_wt_sand2').val(unit_wt_sand2.toFixed(3));
                $('#avg_unit_wt_sand').val(avg_unit_wt_sand.toFixed(3));
            }

            function calculateValues(point) {
                var unit_wt_sand = parseFloat($('#avg_unit_wt_sand').val()) || 0;

                $('#unit_wt_sand-' + point).val(unit_wt_sand.toFixed(2));
                $('#span-unit_wt_sand-' + point).text(unit_wt_sand.toFixed(2));


                var wt_sand_cone = parseFloat($('#wt_sand_cone').val()) || 0;

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

                var wt_wet_soil           = parseFloat($('#wt_wet_soil-' + point).val()) || 0;
                var wt_bottle_sand_before = parseFloat($('#wt_bottle_sand_before-' + point).val()) || 0;
                var wt_bottle_sand_after  = parseFloat($('#wt_bottle_sand_after-' + point).val()) || 0;

                var wt_sand_used          = wt_bottle_sand_before - wt_bottle_sand_after;


                $('#wt_sand_used-' + point).val(wt_sand_used.toFixed(2));
                $('#span-wt_sand_used-' + point).text(wt_sand_used.toFixed(2));

                $('#wt_sand_cone-' + point).val(wt_sand_cone.toFixed(2));
                $('#span-wt_sand_cone-' + point).text(wt_sand_cone.toFixed(2));


                var wt_sand_fill_hole = wt_sand_used-wt_sand_cone;
                $('#wt_sand_fill_hole-' + point).val(wt_sand_fill_hole.toFixed(2));
                $('#span-wt_sand_fill_hole-' + point).text(wt_sand_fill_hole.toFixed(2));

                var hole_volume           = wt_sand_fill_hole/unit_wt_sand;
                $('#hole_volume-' + point).val(hole_volume.toFixed(2));
                $('#span-hole_volume-' + point).text(hole_volume.toFixed(2));

                var wet_density           = wt_wet_soil/hole_volume;
                $('#wet_density-' + point).val(wet_density.toFixed(2));
                $('#span-wet_density-' + point).text(wet_density.toFixed(2));

                var dry_density           = wet_density/(1+(moisture_content/100));
                $('#dry_density-' + point).val(wet_density.toFixed(2));
                $('#span-dry_density-' + point).text(dry_density.toFixed(2));

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
            $('#wt_wet_soil_can-{{ $test->point }}, #wt_dry_soil_can-{{ $test->point }},#wt_wet_soil-{{ $test->point }},#wt_bottle_sand_before-{{ $test->point }},#wt_bottle_sand_after-{{ $test->point }},#wt_can-{{ $test->point }}, #wt_wet_soil_gm-{{ $test->point }}, #req_compaction-{{ $test->point }}').on('keyup', function() {
                calculateValues('{{ $test->point }}');
            });

            calculateValues('{{ $test->point }}');
            @endforeach

            $('#diameter, #height,#mass_mold_sand1,#mass_mold_sand2,#mass_empty_sand').on('keyup', function() {
                calcaulate_volume();
            });

            calcaulate_volume();
        });

    </script>
    @notifyJs

@endsection



