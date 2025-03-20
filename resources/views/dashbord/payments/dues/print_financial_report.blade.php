<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{trans('payment.financial_report')}}</title>
    <style>
        :root {
            --primary-color: #ff8c00;
            --secondary-color: #333;
            --accent-color: #f8f8f8;
            --border-color: #e0e0e0;
            --text-color: #333;
            --text-muted: #666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: var(--text-color);
            line-height: 1.6;
        }

        .statement-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .statement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
            background-color: white;
            border-bottom: 1px solid var(--border-color);
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .company-info img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .company-name span {
            color: var(--primary-color);
            font-weight: 700;
        }

        .company-details {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .statement-title-box {
            text-align: right;
            background-color: var(--accent-color);
            padding: 15px 25px;
            border-radius: 5px;
            border-left: 4px solid var(--primary-color);
        }

        .statement-title {
            font-size: 28px;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .client-name {
            font-size: 18px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .statement-body {
            padding: 30px;
        }

        .client-details {
            margin-bottom: 30px;
            padding: 20px;
            background-color: var(--accent-color);
            border-radius: 5px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-muted);
            min-width: 150px;
        }

        .detail-value {
            font-weight: 500;
        }

        .section-title {
            font-size: 20px;
            color: var(--secondary-color);
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }

        .statement-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .statement-table th {
            background-color: var(--accent-color);
            color: var(--secondary-color);
            padding: 14px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--primary-color);
        }

        .statement-table td {
            padding: 14px 15px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .statement-table tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .statement-table tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .amount-cell {
            text-align: right;
            font-weight: 500;
        }

        .total-row td {
            font-weight: 700;
            border-top: 2px solid var(--border-color);
            border-bottom: none;
            padding-top: 15px;
        }

        .statement-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: var(--accent-color);
            border-top: 1px solid var(--border-color);
        }

        .statement-date {
            font-size: 14px;
            color: var(--text-muted);
        }

        .footer-note {
            text-align: center;
            padding: 15px 30px;
            font-size: 12px;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
        }

        .summary-box {
            background-color: var(--accent-color);
            border-left: 4px solid var(--primary-color);
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .summary-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .summary-value {
            font-weight: 600;
        }

        .total-due {
            font-size: 18px;
            color: var(--primary-color);
            border-top: 1px solid var(--border-color);
            padding-top: 10px;
            margin-top: 10px;
        }

        @media print {
            body {
                background-color: white;
            }

            .statement-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="statement-container print-content">
    <div class="statement-header">
        <div class="company-info">
            <img src="{{ asset('images/' . get_print_image()) }}" alt="ALSHARQ TESTS LABORATORY">
            <div class="company-name"><span>ALSHARQ</span> TESTS LABORATORY</div>
            <div class="company-details">
                <p>Registration No. under Iraqi accreditation system is (124)</p>
                <p>Registration No. under Iraqi Engineer Union is (508)</p>
            </div>
        </div>
        <div class="statement-title-box">
            <div class="statement-title">{{ trans('payment.financial_report') }}</div>
            @if(isset($from_date) && isset($to_date))
                <div class="client-name">
                    {{ $from_date }} - {{ $to_date }}
                </div>
            @endif
        </div>
    </div>

    <div class="statement-body">




        <div class="summary-box">
            <div class="summary-title">{{trans('payment.financial_summary')}}</div>
            <div class="summary-row">
                <span class="summary-label">{{trans('payment.total_invoices')}}:</span>
                <span class="summary-value">{{ ($all_data->count()) }}</span>
            </div>
            <div class="summary-row total-due">
                <span class="summary-label">{{trans('payment.total_amount')}}:</span>
                <span class="summary-value">${{ number_format($all_data->sum('value'), 2) }}</span>
            </div>
        </div>

        <div class="section-title">{{trans('payment.payment_history')}}</div>
        <table class="statement-table">
            <thead>
            <tr>
                <th class="min-w-250px">{{trans('payment.date')}}</th>
                <th class="min-w-150px">{{trans('payment.transaction_type')}}</th>
                <th class="min-w-90px">{{trans('payment.description')}}</th>
                <th class="min-w-90px">{{trans('payment.value')}}</th>
                <th class="min-w-90px">{{trans('payment.total')}}</th>
            </tr>
            </thead>
            <tbody>
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
            <tr class="total-row">
                <td colspan="4" class="text-right">Total{{trans('payment.Total')}}:</td>
                <td class="amount-cell">${{ number_format($all_data->sum('value'), 2) }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="statement-footer">
        <div class="statement-date">
            <strong>{{trans('payment.generated_date')}}:</strong> {{ date('Y-m-d') }}
        </div>
        <div class="statement-time">
            <strong>{{trans('payment.generated_time')}}:</strong> {{ date('H:i') }}
        </div>
    </div>

</div>
</body>
</html>
