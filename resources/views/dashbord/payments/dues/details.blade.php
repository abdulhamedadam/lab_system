<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= trans('dues.dues_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>

            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.client') ?></td>
                <td class="class_result">{{optional($all_data->client)->name}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test') ?></td>
                @php
                        $test_code=optional($all_data->test_data)->test_code;
                        $final_code=get_app_config_data('soil_prefix').$test_code;
                @endphp
                <td class="class_result">{{$final_code}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test_type') ?></td>
                <td class="class_result">{{$all_data->test_type}}</td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('dues.test_title') ?></td>
                <td class="class_result">{{$all_data->test_name}}</td>
            </tr>
            <tr style="background-color: lightcoral">
                <td class="class_label" ><?= trans('dues.test_value') ?></td>
                <td class="class_result">{{$all_data->test_value}}</td>
            </tr>

            <tr style="background-color: lightgreen">
                <td class="class_label"><?= trans('dues.paid') ?></td>
                <td class="class_result" >{{$all_data->test_value - $required_value}}</td>
            </tr>

            <tr style="background-color: lightgoldenrodyellow">
                <td class="class_label"><?= trans('dues.remain') ?></td>
                <td class="class_result">{{ $required_value}}</td>
            </tr>


            <tr>
                <td class="class_label"><?= trans('dues.month') ?></td>
                <td class="class_result">{{$all_data->year}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.year') ?></td>
                <td class="class_result">{{\Carbon\Carbon::createFromFormat('m', $all_data->month)->format('F')}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.created_at') ?></td>
                <td class="class_result">{{\Carbon\Carbon::parse($all_data->created_at)->format('Y-m-d')}}</td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('dues.created_by') ?></td>
                <td class="class_result"></td>
            </tr>


            </tbody>
        </table>
    </div>
</div>
