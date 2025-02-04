<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= trans('tests.test_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('tests.test_code') ?></td>
                <td class="class_result">{{ get_app_config_data('soil_prefix').$all_data->test_code }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('tests.client') ?></td>
                <td class="class_result">{{ $all_data->client ? $all_data->client->name : 'N/A' }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('tests.company') ?></td>
                <td class="class_result">{{ $all_data->company ? $all_data->company->name : 'N/A' }}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('tests.project') ?></td>
                <td class="class_result">{{ $all_data->project ? $all_data->project->project_name : 'N/A' }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('tests.talab_title') ?></td>
                <td class="class_result">{{ $all_data->talab_title }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('tests.talab_date') ?></td>
                <td class="class_result">{{ $all_data->talab_date }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('tests.talab_end_date') ?></td>
                <td class="class_result">{{ $all_data->talab_end_date }}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('tests.sample_number') ?></td>
                <td class="class_result">{{ $all_data->sample_number }}</td>
            </tr>

            <tr>
                <td class="class_label"><?= trans('tests.talab_image') ?></td>
                <td class="class_result">
                  <?php

                      if ($all_data->talab_image) {
                              $imagePath = asset('images/' . $all_data->talab_image);
                              return '<img src="' . $imagePath . '" alt="Employee Image" class="img-thumbnail" style="width: 50px; height: 50px;">';
                          } else{
                              return 'N\A';
                          }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('tests.status') ?></td>
                @php
                    $status_arr=['pending'=>trans('tests.pending'),'received'=>trans('tests.received'),
                            'test_progress'=>trans('tests.test_progress'),'test_done'=>trans('tests.test_done'),'reports_progress'=>trans('tests.reports_progress'),
                            'reports_done'=>trans('tests.reports_done')
                            ];
                @endphp
                <td class="class_result">{{ $status_arr[$all_data->status] }}</td>
            </tr>


            </tbody>
        </table>
    </div>
</div>
