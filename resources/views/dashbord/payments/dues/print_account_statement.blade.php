<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Statement</title>
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
            <div class="statement-title">ACCOUNT STATEMENT</div>
            <div class="client-name">1</div>
        </div>
    </div>

    <div class="statement-body">
        <div class="client-details">
            <div class="detail-row">
                <span class="detail-label">Client:</span>
                <span class="detail-value">1</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Company:</span>
                <span class="detail-value">يبيلغلافلا</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Project:</span>
                <span class="detail-value">ثبققل</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statement Date:</span>
                <span class="detail-value">{{ date('Y-m-d') }}</span>
            </div>
        </div>

        @php
            $totalPayment = $all_data->client_test_payment->sum('value');
        @endphp

        <div class="summary-box">
            <div class="summary-title">ACCOUNT SUMMARY</div>
            <div class="summary-row">
                <span class="summary-label">Total Invoices:</span>
                <span class="summary-value">{{ $all_data->client_test_payment->count() }}</span>
            </div>
            <div class="summary-row total-due">
                <span class="summary-label">Total Amount:</span>
                <span class="summary-value">${{ number_format($totalPayment, 2) }}</span>
            </div>
        </div>

        <div class="section-title">Payment History</div>
        <table class="statement-table">
            <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_data->client_test_payment as $pay)
                <tr>
                    <td>{{ 'INV-' . $pay->num }}</td>
                    <td>{{ $pay->paid_date }}</td>
                    <td class="amount-cell">${{ number_format($pay->value, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2" class="text-right">Total:</td>
                <td class="amount-cell">${{ number_format($totalPayment, 2) }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="statement-footer">
        <div class="statement-date">
            <strong>Generated Date:</strong> {{ date('Y-m-d') }}
        </div>
        <div class="statement-time">
            <strong>Generated Time:</strong> {{ date('H:i') }}
        </div>
    </div>

    <div class="footer-note">
        This statement reflects all transactions up to the statement date. Please contact our accounting department if you have any questions.
    </div>
</div>
</body>
</html>
