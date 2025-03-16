<div class="card-body pt-0" style="padding: 10px">
    <div class="table-responsive">
        <table id="kt_profile_overview_table"
               class="table table-bordered">
            <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th>{{ trans('tests.test_code') }}</th>
                <th>{{ trans('tests.test_name') }}</th>
                <th>{{ trans('tests.sample_number') }}</th>
                <th>{{ trans('tests.test_value') }}</th>
                <th>{{ trans('tests.paid') }}</th>
                <th>{{ trans('tests.remain') }}</th>
                <th>{{ trans('tests.created_at') }}</th>
            </tr>
            </thead>
            <tbody class="fs-6">
            @foreach ($dues_data as $record)
                <!-- Due row with background color and clickable -->
                <tr class="bg-light-primary cursor-pointer" data-bs-toggle="collapse" data-bs-target="#paymentDetails{{ $record->id }}" aria-expanded="true" aria-controls="paymentDetails{{ $record->id }}">
                    <td>{{ get_app_config_data(in_array($record->test_data->test_type, ['soil', 'hasa']) ? 'soil_prefix' : $record->test_data->test_type . '_prefix') . $record->test_data->test_code }}</td>
                    <td>{{ $record->test_name }}</td>
                    <td>{{ optional($record->test_data)->sample_number }}</td>
                    <td>{{ $record->test_value }}</td>
                    <td>{{ $record->client_test_payment->sum('value') }}</td>
                    <td>{{$record->test_value - $record->client_test_payment->sum('value') }}</td>
                    <td>
                        {{ $record->created_at }}
                        <i class="fa fa-chevron-down float-end"></i>
                    </td>
                </tr>

                <tr>
                    <td colspan="12" class="p-0">
                        <div class="collapse " id="paymentDetails{{ $record->id }}">
                            <div class="card card-body m-2 border-0">
                                @if(isset($record->client_test_payment) && count($record->client_test_payment) > 0)
                                    <table class="table table-bordered  align-middle">
                                        <thead class="table-light fs-7 ">
                                        <tr>
                                            <th>{{ trans('payments.num') }}</th>
                                            <th>{{ trans('payments.value') }}</th>
                                            <th>{{ trans('payments.paid_date') }}</th>
                                            <th>{{ trans('payments.payment_type') }}</th>
                                            <th>{{ trans('payments.notes') }}</th>
                                            <th>{{ trans('payments.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($record->client_test_payment as $payment)
                                            <tr>
                                                <td>{{'INV'. $payment->num }}</td>
                                                <td>{{ $payment->value }}</td>
                                                <td>{{ $payment->paid_date }}</td>
                                                <td>{{ $payment->payment_type }}</td>
                                                <td>{{ $payment->notes }}</td>
                                                <td>
                                                    <a href="{{ route('admin.payment.print_invoice',$payment->id) }}"
                                                       class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                                                        <i class="bi bi-printer fs-2 me-1"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning d-flex align-items-center p-3">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <div>
                                            {{ trans('payments.no_payments_found') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Optional spacer row for better visual separation -->
                <tr class="border-0">
                    <td colspan="5" class="p-1"></td>
                </tr>
            @endforeach
            </tbody>

            <a href="{{ route('admin.payment.print_client_account_statment_invoice',[$client_id,$from_date,$to_date]) }}"
               class="btn btn-sm btn-light btn-active-light-primary" target="_blank">
                <i class="bi bi-printer fs-2 me-1"></i>
            </a>
        </table>
    </div>
</div>
