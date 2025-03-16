<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->num }}</title>
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

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .invoice-header {
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

        .invoice-number {
            text-align: right;
            background-color: var(--accent-color);
            padding: 15px 25px;
            border-radius: 5px;
            border-left: 4px solid var(--primary-color);
        }

        .invoice-title {
            font-size: 28px;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .invoice-num {
            font-size: 18px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .invoice-body {
            padding: 30px;
        }

        .invoice-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-group h3 {
            font-size: 18px;
            color: var(--secondary-color);
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary-color);
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
        }

        .detail-value {
            text-align: right;
            font-weight: 500;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        .invoice-table th {
            background-color: var(--accent-color);
            color: var(--secondary-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--primary-color);
        }

        .invoice-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .amount-cell {
            text-align: right;
            font-weight: 600;
        }

        .invoice-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: var(--accent-color);
            border-top: 1px solid var(--border-color);
        }

        .invoice-date {
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

        @media print {
            body {
                background-color: white;
            }

            .invoice-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="invoice-container print-content">
    <div class="invoice-header">
        <div class="company-info">
            <img src="{{ asset('images/' . get_print_image()) }}" alt="ALSHARQ TESTS LABORATORY">
            <div class="company-name"><span>ALSHARQ</span> TESTS LABORATORY</div>
            <div class="company-details">
                <p>Registration No. under Iraqi accreditation system is (124)</p>
                <p>Registration No. under Iraqi Engineer Union is (508)</p>
            </div>
        </div>
        <div class="invoice-number">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-num">#{{ $invoice->num }}</div>
        </div>
    </div>

    <div class="invoice-body">
        <div class="invoice-details">
            <div class="detail-group">
                <h3>Laboratory Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Laboratory Number:</span>
                    <span
                        class="detail-value">{{  get_app_config_data(in_array(optional($invoice->client_test)->test_type, ['soil', 'hasa']) ? 'soil_prefix' : optional(optional($invoice->client_test)->test)->test_type . '_prefix') . optional(optional($invoice->client_test)->test)->test_code}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Book Number:</span>
                    <span class="detail-value">{{optional(optional($invoice->client_test)->test)->book_number}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Request Date:</span>
                    <span class="detail-value">{{optional(optional($invoice->client_test)->test)->talab_date}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Request Number:</span>
                    <span class="detail-value">{{optional(optional($invoice->client_test)->test)->talab_number}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Samples:</span>
                    <span class="detail-value">{{optional(optional($invoice->client_test)->test)->sample_number}}</span>
                </div>
            </div>

            <div class="detail-group">
                <h3>Client Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Client:</span>
                    @if($invoice->client_test->test)
                        <span class="detail-value">{{optional(optional($invoice->client_test)->test)->client->name}}</span>
                    @else
                        <span class="detail-value">{{optional(optional($invoice->client_test)->external_test)->client->name}}</span>
                    @endif
                </div>
                <div class="detail-row">
                    <span class="detail-label">Company:</span>
                    @if($invoice->client_test->test)
                        <span class="detail-value">{{optional(optional($invoice->client_test)->test)->company->name}}</span>
                    @else
                        <span class="detail-value">{{optional(optional($invoice->client_test)->external_test)->company->name}}</span>
                    @endif

                </div>
                <div class="detail-row">
                    <span class="detail-label">Project:</span>
                    @if($invoice->client_test->test)
                        <span class="detail-value">{{optional(optional($invoice->client_test)->test)->project->project_name}}</span>
                    @else
                        <span class="detail-value">{{optional(optional($invoice->client_test)->external_test)->project->project_name}}</span>

                    @endif

                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Method:</span>
                    <span class="detail-value">{{ $invoice->payment_type }}</span>
                </div>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
            <tr>
                <th>Details</th>
                <th style="text-align: right;">Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $invoice->notes }}</td>
                <td class="amount-cell">{{ $invoice->value }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice-footer">
        <div class="invoice-date">
            <strong>Issue Date:</strong> {{ $invoice->created_at->format('Y-m-d') }}
        </div>
        <div class="invoice-time">
            <strong>Issue Time:</strong> {{ $invoice->created_at->format('H:i') }}
        </div>
    </div>

    <div class="footer-note">
        Thank you for your business. All services are provided according to our terms and conditions.
    </div>
</div>
</body>
</html>
