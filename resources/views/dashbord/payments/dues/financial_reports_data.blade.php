<div class="card-body pt-0">
    <div class="table-responsive">
        <table id="kt_profile_overview_table"
               class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
            <thead class="fs-7 text-gray-500 text-uppercase">
            <tr>
                <th class="min-w-250px">{{trans('payment.date')}}</th>
                <th class="min-w-150px">{{trans('payment.transaction_type')}}</th>
                <th class="min-w-90px">{{trans('payment.description')}}</th>
                <th class="min-w-90px">{{trans('payment.value')}}</th>
                <th class="min-w-90px">{{trans('payment.total')}}</th>
            </tr>
            </thead>
            <tbody class="fs-6">
            @php
                $totalIncome = 0;
                $totalExpense = 0;
            @endphp

            @foreach ($all_data as $transaction)
                @php
                    if($transaction->type == 'income') {
                        $totalIncome += $transaction->value;
                    } else {
                        $totalExpense += $transaction->value;
                    }
                @endphp

                <tr>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                    <td>
                        @if($transaction->type == 'income')
                            <span class="badge bg-success"><i class="bi bi-arrow-up"></i> إيراد</span>
                        @else
                            <span class="badge bg-danger"><i class="bi bi-arrow-down"></i> مصروف</span>
                        @endif
                    </td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ number_format($transaction->value, 2) }} $</td>
                    <td>{{ number_format($transaction->balance, 2) }} $</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="table-active">
                <td colspan="3" class="text-end fw-bolder">{{trans('payment.summary')}}</td>
                <td class="fw-bolder">
                    <div class="d-flex flex-column">
                        <span class="text-success"><i class="bi bi-arrow-up"></i> {{trans('payment.total_income')}}: {{ number_format($totalIncome, 2) }} $</span>
                        <span class="text-danger"><i class="bi bi-arrow-down"></i> {{trans('payment.total_expense')}}: {{ number_format($totalExpense, 2) }} $</span>
                    </div>
                </td>
                <td class="fw-bolder">
                    @php
                        $netProfit = $totalIncome - $totalExpense;
                    @endphp

                    @if($netProfit >= 0)
                        <span class="badge bg-success fs-6 p-2"><i class="bi bi-arrow-up"></i> {{trans('payment.net_profit')}}: {{ number_format($netProfit, 2) }} $</span>
                    @else
                        <span class="badge bg-danger fs-6 p-2"><i class="bi bi-arrow-down"></i> {{trans('payment.net_loss')}}: {{ number_format(abs($netProfit), 2) }} $</span>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
