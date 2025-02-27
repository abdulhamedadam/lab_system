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




            </tbody>
        </table>
    </div>
</div>
