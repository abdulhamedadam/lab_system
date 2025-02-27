<div class="" style="margin-top: 30px">
    @if(isset($dues->client_test_payment) && !empty($dues->client_test_payment))
        <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
               width="70%">
            <thead>
            <tr class="greentd" style="background-color: lightgrey" >
                <th>#</th>
                <th>{{ trans('dues.invoice_num') }}</th>
                <th>{{ trans('dues.paid_date') }}</th>
                <th>{{ trans('dues.paid_value') }}</th>
                <th>{{ trans('dues.payment_type') }}</th>
                <th>{{ trans('dues.receivable') }}</th>
                <th>{{ trans('dues.publisher') }}</th>
                <th>{{ trans('dues.added_date') }}</th>
                <th>{{ trans('dues.added_time') }}</th>
                <th>{{ trans('dues.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $x = 1;

            @endphp
            @foreach ($dues->client_test_payment as $pay)

                <tr>
                    <td>{{ $x++ }}</td>
                    <td>Inv-{{ $pay->num }}</td>
                    <td>{{ $pay->paid_date }}</td>
                    <td>{{ $pay->value }}</td>
                    <td>{{ $pay->payment_type }}</td>
                    <td>{{ $pay->receivable->first_name .' '.$pay->receivable->last_name}}</td>
                    <td>{{ $pay->creator->name}}</td>
                    <td class="fnt_center_black">{{ \Illuminate\Support\Carbon::parse($pay->created_at)->format('Y-m-d') }}</td>
                    <td class="fnt_center_red">{{ \Illuminate\Support\Carbon::parse($pay->created_at)->format('H:i:s') }}</td>


                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.employee_download_file', $pay->id) }}" class="btn btn-sm btn-primary" title="{{ trans('dues.edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('admin.employee_delete_file', $pay->id) }}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                            <button class="btn btn-sm btn-success" onclick="printInvoice({{ $pay->id }})">
                                <i class="bi bi-printer"></i> {{ trans('dues.print') }}
                            </button>
                        </div>
                        <iframe id="print-frame-{{ $pay->id }}"
                                style="display: none;"
                                title="Invoice Print Frame"></iframe>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>





