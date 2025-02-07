<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
            .card {
                border: none;
                box-shadow: none;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
            }
            .table th, .table td {
                border: 1px solid #000;
                padding: 8px;
            }
            .greentd {
                background-color: lightgrey !important;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card no-print">
        <div class="card-header">
            <h3 class="card-title">Test Report</h3>
            <button class="btn btn-primary float-right" onclick="window.print()">Print Report</button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #f8f9fa;">
            <h3 class="card-title">{{ trans('tests.samples_test') }}</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="greentd">
                            <th>{{ trans('tests.test_code') }}</th>
                            <th>{{ trans('tests.test_carried_date') }}</th>
                            <th>{{ trans('tests.proctor_test_date') }}</th>
                            <th>{{ trans('tests.sample_collect_date') }}</th>
                            <th>{{ trans('tests.location') }}</th>
                            <th>{{ trans('tests.proctor_ref') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ get_app_config_data('soil_prefix').$all_data->test_code }}</td>
                            <td>{{ $compaction_test[0]->test_carried_date }}</td>
                            <td>{{ $compaction_test[0]->proctor_test_date }}</td>
                            <td>{{ $compaction_test[0]->sample_collect_date }}</td>
                            <td>{{ $compaction_test[0]->location }}</td>
                            <td>{{ $compaction_test[0]->proctor_ref }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="greentd">
                            <th>{{ trans('tests.test_method') }}</th>
                            <th>{{ trans('tests.material_desc') }}</th>
                            <th>{{ trans('tests.mdd') }}</th>
                            <th>{{ trans('tests.moc') }}</th>
                            <th>{{ trans('tests.mold_number') }}</th>
                            <th>{{ trans('tests.diameter') }}</th>
                            <th>{{ trans('tests.height') }}</th>
                            <th>{{ trans('tests.volume') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $compaction_test[0]->test_method }}</td>
                            <td>{{ $compaction_test[0]->material_desc }}</td>
                            <td>{{ $compaction_test[0]->mdd }}</td>
                            <td>{{ $compaction_test[0]->moc }}</td>
                            <td>{{ $compaction_test[0]->mold_number }}</td>
                            <td>{{ $compaction_test[0]->diameter }}</td>
                            <td>{{ $compaction_test[0]->height }}</td>
                            <td>{{ $compaction_test[0]->volume }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="greentd">
                            <th>{{ trans('tests.point_number') }}</th>
                            @foreach ($compaction_test[0]->compaction_test_details as $test)
                                <th>{{ $test->point }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $table_data=[
                                1=>['name'=>'point_location','type'=>'text','readonly'=>false,'background'=>'','value'=> ''],
                                2=>['name'=>'layer_number','type'=>'text','readonly'=>false,'background'=>'','value'=>''],
                                3=>['name'=>'can_number','type'=>'text','readonly'=>false,'background'=>'','value'=>''],
                                4=>['name'=>'wt_wet_soil_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                5=>['name'=>'wt_dry_soil_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                6=>['name'=>'wt_moisture','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                8=>['name'=>'wt_can','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                9=>['name'=>'wt_dry_soil','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                10=>['name'=>'moisture_content','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                11=>['name'=>'wt_wet_soil_gm','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                12=>['name'=>'mulod_volume','type'=>'hidden','readonly'=>false,'background'=>'#ffcdc3','value'=>''],
                                13=>['name'=>'wet_density','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                14=>['name'=>'dry_density','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                15=>['name'=>'max_dry_density','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                16=>['name'=>'compaction','type'=>'hidden','readonly'=>true,'background'=>'#ffcdc3','value'=>''],
                                17=>['name'=>'req_compaction','type'=>'number','readonly'=>false,'background'=>'','value'=>''],
                                18=>['name'=>'evaluation','type'=>'hidden','readonly'=>true,'background'=>'','value'=>''],
                            ];
                        @endphp
                        @foreach ($table_data as $key => $value)
                            <tr>
                                <td style="background-color: khaki;">{{ trans('tests.' . $value['name']) }}</td>
                                @foreach ($compaction_test[0]->compaction_test_details as $test)
                                    <td style="background-color: {{ $value['background'] }}">
                                        {{ old($value['name'] . '-' . $test->point, data_get($test, $value['name'], '')) }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
