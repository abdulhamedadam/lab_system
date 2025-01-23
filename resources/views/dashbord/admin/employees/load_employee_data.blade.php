<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= trans('employees.employee_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.name') ?></td>
                <td class="class_result"><?php echo $all_data->first_name.' '.$all_data->last_name ; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.employee_code') ?></td>
                <td class="class_result"><?php echo $all_data->emp_code; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.email') ?></td>
                <td class="class_result"><?php echo $all_data->email; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= trans('employees.national_id') ?></td>
                <td class="class_result"><?php echo $all_data->national_id; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.gender') ?></td>
                <td class="class_result"><?php echo trans('employees.'.$all_data->gender); ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.branch') ?></td>
                <td class="class_result"><?php echo $all_data->branch->name; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.position') ?></td>
                <td class="class_result"><?php echo $all_data->position; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.governate') ?></td>
                <td class="class_result"><?php echo $all_data->governate->title; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.area') ?></td>
                <td class="class_result"><?php echo $all_data->area->title; ?></td>
            </tr>
            <tr>
                <td class="class_label"><?= trans('employees.details') ?></td>
                <td class="class_result"><a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#modaldetails" onclick="employee_details({{$all_data->id}})" ><i class="fa-solid fa-list"></i>{{trans('employees.detail_employee')}}</a></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modaldetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?=trans('employees.employee_details')?></h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>

            <div id="result_info">

            </div>

        </div>
    </div>
</div>
@section('js')
    <script>
        function employee_details(id)
        {
            $.ajax({
                url: "{{ route('admin.employee_details', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {

                    $('#result_info').html(html);
                },
            });
        }
    </script>
@endsection
