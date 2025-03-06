<div class="table-responsive" style="padding: 10px">
    <table id="kt_profile_overview_table"
           class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
        <thead class="fs-7 text-gray-500 text-uppercase">
        <tr>

            <th>{{trans('tests.num')}}</th>
            <th>{{trans('tests.value')}}</th>
            <th>{{trans('tests.paid_date')}}</th>
            <th>{{trans('tests.paid_type')}}</th>
             <th>{{trans('tests.action')}}</th>

        </tr>
        </thead>
        <tbody class="fs-6">
        @foreach($dues as $record)

            <tr>
                <td>{{'INV-'.$record->num}}</td>
                <td>{{$record->value}}</td>
                <td>{{$record->paid_date}}</td>
                <td>{{$record->paid_type}}</td>


                <td>
                    <a href="{{ route('admin.payment.print_invoice',$record->id) }}"
                       class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                        <i class="bi bi-printer fs-2 me-1"></i>
                    </a>
                </td>

            </tr>


        @endforeach
        </tbody>
    </table>
    <!--end::Table-->
</div>
