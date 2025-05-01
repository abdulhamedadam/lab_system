<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('payment.payments_report') }}</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #f8f9fa;
            --border-color: #e0e0e0;
            --success-color: #27ae60;
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
            font-size: 14px;
        }

        .statement-container {
            max-width: 1000px;
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
            flex: 1;
        }

        .company-info img {
            max-width: 180px;
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--secondary-color);
        }

        .company-name span {
            color: var(--primary-color);
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
            font-size: 24px;
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .report-period {
            font-size: 16px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .statement-body {
            padding: 30px;
        }

        .summary-box {
            background-color: var(--accent-color);
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .summary-item {
            margin-bottom: 10px;
            flex: 1;
            min-width: 200px;
        }

        .summary-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .total-amount {
            color: var(--success-color);
            font-size: 20px;
        }

        .section-title {
            font-size: 20px;
            color: var(--secondary-color);
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
            font-weight: 600;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .payment-table th {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 15px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid var(--border-color);
        }

        .payment-table td {
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            text-align: center;
        }

        .payment-table tr:nth-child(even) {
            background-color: var(--accent-color);
        }

        .payment-table tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .amount {
            font-weight: 600;
            color: var(--success-color);
            text-align: right;
        }

        .total-row td {
            font-weight: 700;
            background-color: var(--secondary-color);
            color: white;
            border-top: 2px solid var(--border-color);
        }

        .statement-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: var(--accent-color);
            border-top: 1px solid var(--border-color);
            font-size: 13px;
        }

        .footer-note {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
        }

        @media print {
            body {
                background-color: white;
                font-size: 12px;
            }

            .statement-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }

            .payment-table th,
            .payment-table td {
                padding: 8px 10px;
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="statement-container">
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
            <div class="statement-title">{{ trans('payment.payments_report') }}</div>
            @if($from_date || $to_date)
                <div class="report-period">
                    {{ date('d/m/Y', strtotime($from_date)) }} - {{ date('d/m/Y', strtotime($to_date)) }}
                </div>
            @endif
        </div>
    </div>

    <div class="statement-body">
        <div class="summary-box">
            <div class="summary-item">
                <div class="summary-label">{{ trans('payment.total_payments') }}</div>
                <div class="summary-value">{{ $all_data->count() }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">{{ trans('payment.total_amount') }}</div>
                <div class="summary-value total-amount">{{ number_format($all_data->sum('value'), 2) }} دينار</div>
            </div>
            @if(isset($company_name))
            <div class="summary-item">
                <div class="summary-label">{{ trans('payment.company') }}</div>
                <div class="summary-value">{{ $company_name }}</div>
            </div>
            @endif
        </div>

        <div class="section-title">{{ trans('payment.payment_details') }}</div>
        <table class="payment-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('payment.invoice_number') }}</th>
                    <th>{{ trans('payment.company') }}</th>
                    <th>{{ trans('payment.test_code') }}</th>
                    <th>{{ trans('payment.test_name') }}</th>
                    <th>{{ trans('payment.payment_date') }}</th>
                    <th>{{ trans('payment.payment_type') }}</th>
                    <th>{{ trans('payment.amount') }}</th>
                    <th>{{ trans('payment.notes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_data as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>INV{{ $record->num }}</td>
                    <td>{{ optional($record->company)->name }}</td>
                    <td>{{ optional($record->client_test->test)->test_code_st }}</td>
                    <td>{{ optional($record->client_test)->test_name }}</td>
                    <td>{{ date('d/m/Y', strtotime($record->paid_date)) }}</td>
                    <td>{{ $record->payment_type }}</td>
                    <td class="amount">{{ number_format($record->value, 2) }}</td>
                    <td>{{ $record->notes }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="7" class="text-right">{{ trans('payment.total') }}:</td>
                    <td colspan="2" class="amount">{{ number_format($all_data->sum('value'), 2) }} دينار</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="statement-footer">
        <div class="statement-date">
            <strong>{{ trans('payment.generated_on') }}:</strong> {{ date('d/m/Y H:i') }}
        </div>
        <div class="statement-user">
            <strong>{{ trans('payment.generated_by') }}:</strong> {{ auth()->user()->name ?? 'System' }}
        </div>
    </div>

    <div class="footer-note">
        {{ trans('payment.report_footer_note') }}
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>
