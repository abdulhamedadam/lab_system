<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Account Statement</title>
    <style>
        :root {
            --primary-color: #0056b3;
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

        .company-logo {
            width: 150px;
            height: 60px;
            background-color: #f0f0f0;
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #888;
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

        .test-details {
            margin-top: 20px;
        }

        .test-row {
            background-color: #f0f7ff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .test-row:hover {
            background-color: #e0f0ff;
        }

        .payment-details {
            padding: 0;
        }

        .payment-details-content {
            padding: 15px;
            background-color: #fafafa;
            border: 1px solid #eee;
            border-radius: 4px;
            margin: 10px 0;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .payment-table th, .payment-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .payment-table th {
            background-color: #f5f5f5;
            font-weight: 600;
            text-align: left;
        }

        .payment-warning {
            background-color: #fff8e6;
            border: 1px solid #ffe0b2;
            color: #856404;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .payment-warning i {
            margin-right: 10px;
            font-size: 18px;
        }

        .collapsed-icon {
            transition: transform 0.2s;
        }

        .expanded .collapsed-icon {
            transform: rotate(180deg);
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
            <div class="company-logo">COMPANY LOGO</div>
            <div class="company-name"><span>ACME</span> CORPORATION</div>
            <div class="company-details">
                <p>Registration No: 124567890</p>
                <p>Tax ID: T-8765432100</p>
                <p>123 Business Avenue, Suite 500</p>
                <p>Business City, BC 12345</p>
            </div>
        </div>
        <div class="statement-title-box">
            <div class="statement-title">ACCOUNT STATEMENT</div>
            <div class="client-name">Client #C-12345</div>
        </div>
    </div>

    <div class="statement-body">
        <div class="client-details">
            <div class="detail-row">
                <span class="detail-label">Client:</span>
                <span class="detail-value">XYZ Company Ltd.</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Contact Person:</span>
                <span class="detail-value">John Smith</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Project:</span>
                <span class="detail-value">Downtown Building Project</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statement Period:</span>
                <span class="detail-value">Jan 1, 2025 - Mar 15, 2025</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statement Date:</span>
                <span class="detail-value">March 16, 2025</span>
            </div>
        </div>

        <div class="summary-box">
            <div class="summary-title">ACCOUNT SUMMARY</div>
            <div class="summary-row">
                <span class="summary-label">Total Tests:</span>
                <span class="summary-value">5</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Total Amount:</span>
                <span class="summary-value">$12,500.00</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Amount Paid:</span>
                <span class="summary-value">$8,750.00</span>
            </div>
            <div class="summary-row total-due">
                <span class="summary-label">Remaining Balance:</span>
                <span class="summary-value">$3,750.00</span>
            </div>
        </div>

        <div class="section-title">Test Details</div>
        <div class="test-details">
            <table class="statement-table">
                <thead>
                <tr>
                    <th>Test Code</th>
                    <th>Test Name</th>
                    <th>Sample Number</th>
                    <th class="text-right">Test Value</th>
                    <th class="text-right">Paid</th>
                    <th class="text-right">Remaining</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <!-- Test Row 1 -->
                <tr class="test-row" onclick="toggleDetails('test1')">
                    <td>SOIL-001</td>
                    <td>Soil Composition Analysis</td>
                    <td>SMP-2501</td>
                    <td class="amount-cell">$3,500.00</td>
                    <td class="amount-cell">$3,500.00</td>
                    <td class="amount-cell">$0.00</td>
                    <td>Jan 15, 2025 <span class="collapsed-icon">▼</span></td>
                </tr>
                <tr class="payment-details" id="test1" style="display: none;">
                    <td colspan="7" class="p-0">
                        <div class="payment-details-content">
                            <table class="payment-table">
                                <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Payment Type</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>INV-10051</td>
                                    <td>$3,500.00</td>
                                    <td>Jan 20, 2025</td>
                                    <td>Bank Transfer</td>
                                    <td>Initial payment</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

                <!-- Test Row 2 -->
                <tr class="test-row" onclick="toggleDetails('test2')">
                    <td>CHEM-042</td>
                    <td>Chemical Composition Test</td>
                    <td>SMP-2502</td>
                    <td class="amount-cell">$2,800.00</td>
                    <td class="amount-cell">$2,100.00</td>
                    <td class="amount-cell">$700.00</td>
                    <td>Feb 02, 2025 <span class="collapsed-icon">▼</span></td>
                </tr>
                <tr class="payment-details" id="test2" style="display: none;">
                    <td colspan="7" class="p-0">
                        <div class="payment-details-content">
                            <table class="payment-table">
                                <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Payment Type</th>
                                    <th>Notes</th>
