@extends('dashbord.layouts.master')
@section('css')

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

                        <form action="{{ route('admin.company_store_project',$all_data->id) }}" method="post" enctype="multipart/form-data"
                              id="store_form">
                            @csrf
                            <div class="col-md-12 row" style="margin-top: 10px">
                                <input type="hidden" name="soil_test_id" id="soil_test_id" value="{{$all_data->id}}">

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
                                        <input type="date" class="form-control" name="test_carried_date" id="test_carried_date" value="{{date('Y-m-d')}}">
                                    </div>
                                    @error('test_carried_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.proctor_test_date') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                        <input type="date" class="form-control" name="proctor_test_date" id="proctor_test_date" value="{{date('Y-m-d')}}">
                                    </div>
                                    @error('proctor_test_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="project_code" class="form-label">{{ trans('tests.sample_collect_date') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                        <input type="date" class="form-control" name="sample_collect_date" id="sample_collect_date" value="{{date('Y-m-d')}}">
                                    </div>
                                    @error('sample_collect_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.location') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="location" id="location" value="{{old('location')}}">
                                    </div>
                                    @error('location')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="proctor_ref" class="form-label">{{ trans('tests.proctor_ref') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="proctor_ref" id="proctor_ref" value="{{old('proctor_ref')}}">
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
                                        <input type="text" class="form-control" name="test_method" id="test_method" value="{{old('test_method')}}">
                                    </div>
                                    @error('test_method')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.material_desc') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                        <input type="text" class="form-control" name="material_desc" id="material_desc" value="{{old('material_desc')}}">
                                    </div>
                                    @error('material_desc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mdd') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="mdd" id="mdd" value="{{old('mdd')}}">
                                    </div>
                                    @error('mdd')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.moc') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="moc" id="moc" value="{{old('moc')}}">
                                    </div>
                                    @error('moc')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.mold_number') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="mold_number" id="mold_number" value="{{old('mold_number')}}">
                                    </div>
                                    @error('mold_number')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.diameter') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="diameter" id="diameter" value="{{old('diameter')}}">
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
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="height" id="height" value="{{old('diameter')}}">
                                    </div>
                                    @error('height')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label for="location" class="form-label">{{ trans('tests.volume') }}</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                        <input type="number" step="0.02" class="form-control" name="volume" id="volume" value="{{old('volume')}}">
                                    </div>
                                    @error('height')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 row" style="margin-top: 10px; direction: ltr;">
                                <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0" width="70%" style="direction: ltr;">
                                    <thead>
                                    <tr class="greentd" style="background-color: lightgrey">
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
                                        $table_data=[
                                            1=>['name'=>'point_location','type'=>'text','readonly'=>false,'background'=>'','value'=>''],
                                            2=>['name'=>'layer_number','type'=>'text','readonly'=>false,'background'=>'','value'=>''],
                                            3=>['name'=>'can_number','type'=>'text','readonly'=>false,'background'=>'','value'=>''],
                                            4=>['name'=>'wt_wet_soil_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            5=>['name'=>'wt_dry_soil_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            6=>['name'=>'wt_moisture','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                            8=>['name'=>'wt_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            9=>['name'=>'wt_dry_soil','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                            10=>['name'=>'moisture_content','type'=>'number','readonly'=>true,'background'=>'','value'=>''],
                                            11=>['name'=>'wt_wet_soil_gm','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            12=>['name'=>'mulod_volume','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            13=>['name'=>'wet_density','type'=>'number','readonly'=>true,'background'=>'','value'=>''],
                                            14=>['name'=>'dry_density','type'=>'number','readonly'=>true,'background'=>'','value'=>''],
                                            15=>['name'=>'max_dry_density','type'=>'number','readonly'=>true,'background'=>'','value'=>''],
                                            16=>['name'=>'compaction','type'=>'number','readonly'=>true,'background'=>'','value'=>''],
                                            17=>['name'=>'req_compaction','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                            18=>['name'=>'evaluation','type'=>'text','readonly'=>true,'background'=>'','value'=>''],
                                        ];
                                    @endphp
                                    @foreach ($table_data as $key=>$value)
                                        <tr>
                                            <td style="width:200px; background-color: khaki;">{{trans('tests.'.$value['name'])}}</td>
                                            @foreach ($compaction_test[0]->compaction_test_details as $test)
                                                <td style="background-color: {{$value['background']}}"><span id="span-{{$value['name']}}-{{ $test->point }}"></span><input style="text-align-last: center" type="{{$value['type']}}" value="{{$value['value']}}" class="form-control" name="{{$value['name']}}-{{ $test->point }}" id="{{$value['name']}}-{{ $test->point }}" @if($value['readonly']) readonly @endif></td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>





                            <div class="col-md-12 row" style="margin-top: 10px">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-flat">
                                            <?= trans('company.SaveButton') ?>
                                        </button>
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
            function calculateValues(point) {
                var wt_wet_soil_can = parseFloat($('#wt_wet_soil_can-' + point).val()) || 0;
                var wt_dry_soil_can = parseFloat($('#wt_dry_soil_can-' + point).val()) || 0;
                var wt_can = parseFloat($('#wt_can-' + point).val()) || 0;
                var wt_moisture = wt_wet_soil_can - wt_dry_soil_can;
                $('#wt_moisture-' + point).val(wt_moisture.toFixed(2));
                $('#span-wt_moisture-' + point).text(wt_moisture.toFixed(2));
                var wt_dry_soil = wt_dry_soil_can - wt_can;
                $('#wt_dry_soil-' + point).val(wt_dry_soil.toFixed(2));
                $('#span-wt_dry_soil-' + point).text(wt_dry_soil.toFixed(2));
            }
            @foreach ($compaction_test[0]->compaction_test_details as $test)
            $('#wt_wet_soil_can-{{ $test->point }}, #wt_dry_soil_can-{{ $test->point }}, #wt_can-{{ $test->point }}').on('keyup', function() {
                calculateValues('{{ $test->point }}');
            });
            @endforeach
        });
    </script>
    @notifyJs

@endsection



