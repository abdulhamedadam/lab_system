{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Account Statement</title>--}}
{{--    <style>--}}
{{--        :root {--}}
{{--            --primary-color: #ff8c00;--}}
{{--            --secondary-color: #333;--}}
{{--            --accent-color: #f8f8f8;--}}
{{--            --border-color: #e0e0e0;--}}
{{--            --text-color: #333;--}}
{{--            --text-muted: #666;--}}
{{--        }--}}

{{--        * {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;--}}
{{--        }--}}

{{--        body {--}}
{{--            background-color: #f5f5f5;--}}
{{--            color: var(--text-color);--}}
{{--            line-height: 1.6;--}}
{{--        }--}}

{{--        .statement-container {--}}
{{--            max-width: 800px;--}}
{{--            margin: 20px auto;--}}
{{--            background: white;--}}
{{--            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);--}}
{{--            border-radius: 8px;--}}
{{--            overflow: hidden;--}}
{{--        }--}}

{{--        .statement-header {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--            padding: 30px;--}}
{{--            background-color: white;--}}
{{--            border-bottom: 1px solid var(--border-color);--}}
{{--        }--}}

{{--        .company-info {--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            align-items: flex-start;--}}
{{--        }--}}

{{--        .company-info img {--}}
{{--            max-width: 150px;--}}
{{--            margin-bottom: 15px;--}}
{{--        }--}}

{{--        .company-name {--}}
{{--            font-size: 24px;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 5px;--}}
{{--        }--}}

{{--        .company-name span {--}}
{{--            color: var(--primary-color);--}}
{{--            font-weight: 700;--}}
{{--        }--}}

{{--        .company-details {--}}
{{--            font-size: 13px;--}}
{{--            color: var(--text-muted);--}}
{{--            line-height: 1.4;--}}
{{--        }--}}

{{--        .statement-title-box {--}}
{{--            text-align: right;--}}
{{--            background-color: var(--accent-color);--}}
{{--            padding: 15px 25px;--}}
{{--            border-radius: 5px;--}}
{{--            border-left: 4px solid var(--primary-color);--}}
{{--        }--}}

{{--        .statement-title {--}}
{{--            font-size: 28px;--}}
{{--            color: var(--secondary-color);--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .client-name {--}}
{{--            font-size: 18px;--}}
{{--            color: var(--primary-color);--}}
{{--            font-weight: 600;--}}
{{--        }--}}

{{--        .statement-body {--}}
{{--            padding: 30px;--}}
{{--        }--}}

{{--        .client-details {--}}
{{--            margin-bottom: 30px;--}}
{{--            padding: 20px;--}}
{{--            background-color: var(--accent-color);--}}
{{--            border-radius: 5px;--}}
{{--        }--}}

{{--        .detail-row {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            margin-bottom: 10px;--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        .detail-label {--}}
{{--            font-weight: 600;--}}
{{--            color: var(--text-muted);--}}
{{--            min-width: 150px;--}}
{{--        }--}}

{{--        .detail-value {--}}
{{--            font-weight: 500;--}}
{{--        }--}}

{{--        .section-title {--}}
{{--            font-size: 20px;--}}
{{--            color: var(--secondary-color);--}}
{{--            margin: 30px 0 20px 0;--}}
{{--            padding-bottom: 10px;--}}
{{--            border-bottom: 2px solid var(--primary-color);--}}
{{--        }--}}

{{--        .statement-table {--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--            margin-bottom: 30px;--}}
{{--        }--}}

{{--        .statement-table th {--}}
{{--            background-color: var(--accent-color);--}}
{{--            color: var(--secondary-color);--}}
{{--            padding: 14px 15px;--}}
{{--            text-align: left;--}}
{{--            font-weight: 600;--}}
{{--            font-size: 14px;--}}
{{--            border-bottom: 2px solid var(--primary-color);--}}
{{--        }--}}

{{--        .statement-table td {--}}
{{--            padding: 14px 15px;--}}
{{--            border-bottom: 1px solid var(--border-color);--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        .statement-table tr:nth-child(even) {--}}
{{--            background-color: rgba(0, 0, 0, 0.02);--}}
{{--        }--}}

{{--        .statement-table tr:hover {--}}
{{--            background-color: rgba(0, 0, 0, 0.03);--}}
{{--        }--}}

{{--        .text-center {--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        .text-right {--}}
{{--            text-align: right;--}}
{{--        }--}}

{{--        .amount-cell {--}}
{{--            text-align: right;--}}
{{--            font-weight: 500;--}}
{{--        }--}}

{{--        .total-row td {--}}
{{--            font-weight: 700;--}}
{{--            border-top: 2px solid var(--border-color);--}}
{{--            border-bottom: none;--}}
{{--            padding-top: 15px;--}}
{{--        }--}}

{{--        .statement-footer {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--            padding: 20px 30px;--}}
{{--            background-color: var(--accent-color);--}}
{{--            border-top: 1px solid var(--border-color);--}}
{{--        }--}}

{{--        .statement-date {--}}
{{--            font-size: 14px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        .footer-note {--}}
{{--            text-align: center;--}}
{{--            padding: 15px 30px;--}}
{{--            font-size: 12px;--}}
{{--            color: var(--text-muted);--}}
{{--            border-top: 1px solid var(--border-color);--}}
{{--        }--}}

{{--        .summary-box {--}}
{{--            background-color: var(--accent-color);--}}
{{--            border-left: 4px solid var(--primary-color);--}}
{{--            padding: 15px 20px;--}}
{{--            margin-bottom: 30px;--}}
{{--            border-radius: 5px;--}}
{{--        }--}}

{{--        .summary-title {--}}
{{--            font-size: 16px;--}}
{{--            font-weight: 600;--}}
{{--            color: var(--secondary-color);--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .summary-row {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            margin-bottom: 8px;--}}
{{--        }--}}

{{--        .summary-label {--}}
{{--            color: var(--text-muted);--}}
{{--            font-weight: 500;--}}
{{--        }--}}

{{--        .summary-value {--}}
{{--            font-weight: 600;--}}
{{--        }--}}

{{--        .total-due {--}}
{{--            font-size: 18px;--}}
{{--            color: var(--primary-color);--}}
{{--            border-top: 1px solid var(--border-color);--}}
{{--            padding-top: 10px;--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        @media print {--}}
{{--            body {--}}
{{--                background-color: white;--}}
{{--            }--}}

{{--            .statement-container {--}}
{{--                box-shadow: none;--}}
{{--                margin: 0;--}}
{{--                max-width: 100%;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="statement-container print-content">--}}
{{--    <div class="statement-header">--}}
{{--        <div class="company-info">--}}
{{--            <img src="{{ asset('images/' . get_print_image()) }}" alt="ALSHARQ TESTS LABORATORY">--}}
{{--            <div class="company-name"><span>ALSHARQ</span> TESTS LABORATORY</div>--}}
{{--            <div class="company-details">--}}
{{--                <p>Registration No. under Iraqi accreditation system is (124)</p>--}}
{{--                <p>Registration No. under Iraqi Engineer Union is (508)</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="statement-title-box">--}}
{{--            <div class="statement-title">ACCOUNT STATEMENT</div>--}}
{{--            <div class="client-name">1</div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="statement-body">--}}
{{--        <div class="client-details">--}}
{{--            <div class="detail-row">--}}
{{--                <span class="detail-label">Client:</span>--}}
{{--                <span class="detail-value">1</span>--}}
{{--            </div>--}}
{{--            <div class="detail-row">--}}
{{--                <span class="detail-label">Company:</span>--}}
{{--                <span class="detail-value">يبيلغلافلا</span>--}}
{{--            </div>--}}
{{--            <div class="detail-row">--}}
{{--                <span class="detail-label">Project:</span>--}}
{{--                <span class="detail-value">ثبققل</span>--}}
{{--            </div>--}}
{{--            <div class="detail-row">--}}
{{--                <span class="detail-label">Statement Date:</span>--}}
{{--                <span class="detail-value">{{ date('Y-m-d') }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @php--}}
{{--            $totalPayment = $all_data->client_test_payment->sum('value');--}}
{{--        @endphp--}}

{{--        <div class="summary-box">--}}
{{--            <div class="summary-title">ACCOUNT SUMMARY</div>--}}
{{--            <div class="summary-row">--}}
{{--                <span class="summary-label">Total Invoices:</span>--}}
{{--                <span class="summary-value">{{ $all_data->client_test_payment->count() }}</span>--}}
{{--            </div>--}}
{{--            <div class="summary-row total-due">--}}
{{--                <span class="summary-label">Total Amount:</span>--}}
{{--                <span class="summary-value">${{ number_format($totalPayment, 2) }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="section-title">Payment History</div>--}}
{{--        <table class="statement-table">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>Invoice Number</th>--}}
{{--                <th>Date</th>--}}
{{--                <th class="text-right">Amount</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($all_data->client_test_payment as $pay)--}}
{{--                <tr>--}}
{{--                    <td>{{ 'INV-' . $pay->num }}</td>--}}
{{--                    <td>{{ $pay->paid_date }}</td>--}}
{{--                    <td class="amount-cell">دينار{{ number_format($pay->value, 2) }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            <tr class="total-row">--}}
{{--                <td colspan="2" class="text-right">Total:</td>--}}
{{--                <td class="amount-cell">دينار{{ number_format($totalPayment, 2) }}</td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

{{--    <div class="statement-footer">--}}
{{--        <div class="statement-date">--}}
{{--            <strong>Generated Date:</strong> {{ date('Y-m-d') }}--}}
{{--        </div>--}}
{{--        <div class="statement-time">--}}
{{--            <strong>Generated Time:</strong> {{ date('H:i') }}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="footer-note">--}}
{{--        This statement reflects all transactions up to the statement date. Please contact our accounting department if--}}
{{--        you have any questions.--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lab Invoice - RTL</title>
    <meta name="description" content="Professional Laboratory Invoice Template"/>
    <meta name="author" content="Lovable"/>

    <!-- Add Arabic font support -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap">

    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
            /* Fix A4 dimensions explicitly */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f3f4f6;
            color: #1a1a1a;
            line-height: 1.6;
            /* Add print-specific body class */
        }

        body.printing {
            width: 210mm;
            height: 297mm;
            background-color: white;
        }

        .container {
            max-width: 210mm; /* A4 width */
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Print Button Styles */
        .print-button-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 16px;
        }

        .print-button {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 8px 16px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .print-button:hover {
            background-color: #f9fafb;
        }

        /* Invoice Container Styles */
        .invoice-container {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Header Styles */
        .invoice-header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .header-right h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 4px;
        }

        .header-right p {
            color: #6b7280;
            font-size: 14px;
        }


        /* Lab Logo and Information */
        .lab-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .lab-logo {
            color: #1e3a8a;
            display: flex;
            justify-content: center;
        }

        .lab-info {
            text-align: left;
        }

        .lab-name {
            font-weight: bold;
            font-size: 16px;
            color: #1e3a8a;
            margin-bottom: 4px;
        }

        .registration-info {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        /* Info Section Styles */
        .info-section {
            margin-bottom: 24px;
        }

        .info-section h2 {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            width: 100%;
        }

        .info-column {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
        }

        .info-label {
            font-weight: 600;
        }

        /* Table Styles */
        .invoice-table-section {
            margin-bottom: 32px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #dbeafe;
        }

        .amount-column {
            text-align: left;
        }

        .total-row {
            background-color: #f3f4f6;
        }

        .bold {
            font-weight: bold;
        }

        /* Footer Styles */
        .invoice-footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
        }

        .footer-left p {
            font-size: 14px;
            color: #6b7280;
        }

        .footer-right {
            text-align: left;
            font-size: 14px;
            color: #6b7280;
        }

        /* Print Media Query */
        @media print {
            /* A4 paper size is 210mm x 297mm */
            html, body {
                width: 210mm;
                height: 297mm;
                background-color: white;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Reset the container for printing */
            .container {
                width: 190mm; /* A4 width minus margins */
                height: auto;
                max-width: 190mm;
                max-height: 277mm; /* A4 height minus margins */
                margin: 0 auto;
                padding: 0;
                overflow: visible;
            }

            .invoice-container {
                border: none;
                border-radius: 0;
                box-shadow: none;
                padding: 15mm 10mm; /* Add adequate padding */
                width: 100%;
                height: auto;
                page-break-inside: avoid;
            }

            /* Ensure table content is visible */
            .table-container {
                overflow-x: visible;
            }

            table {
                width: 100% !important;
                table-layout: fixed !important;
                page-break-inside: avoid !important;
                border-collapse: collapse !important;
            }

            th, td {
                page-break-inside: avoid !important;
                border: 1px solid #000 !important; /* Make borders darker for print */
                word-wrap: break-word !important;
                padding: 6px !important;
            }

            th {
                background-color: #dbeafe !important; /* Force background color */
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .total-row {
                background-color: #f3f4f6 !important; /* Force background color */
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            /* Additional print-specific styles to ensure content visibility */
            .invoice-table-section {
                display: block !important;
                visibility: visible !important;
            }

            .info-section, .info-grid, .info-column, .info-row {
                display: block !important;
                visibility: visible !important;
            }

            /* Keep info grid as grid for better print layout */
            .info-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                width: 100% !important;
                gap: 10px !important;
            }

            .info-column {
                display: flex !important;
                flex-direction: column !important;
                width: 100% !important;
            }

            .info-row {
                margin-bottom: 5px !important;
                width: 100% !important;
                display: flex !important;
                justify-content: space-between !important;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <!-- Print Button -->
    <div class="print-button-container no-print">
        <button id="printButton" class="print-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9V2h12v7"/>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                <path d="M6 14h12v8H6z"/>
            </svg>
            <span>طباعة الفاتورة</span>
        </button>
    </div>

    <!-- Invoice Container -->
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="header-right">
                    <h1>كشف حساب اختبار</h1>
                    <p>رقم الاختبار: {{ optional($all_data->test)->test_code_st }}</p>
                </div>
                <div class="header-left">
                    <div class="lab-logo-container">
                        <div class="lab-logo">
                            <img src="{{ asset('images/' . get_print_image()) }}" alt="ALSHARQ TESTS LABORATORY"
                                 style="width:100px">
                        </div>
                        <div class="lab-info">
                            <h2 class="lab-name">ALSHARQ TESTS LABORATORY</h2>
                            <p class="registration-info">Registration No. under Iraqi accreditation system is (124)</p>
                            <p class="registration-info">Registration No. under Iraqi Engineer Union is (508)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="info-section">
            <h2>معلومات المختبر</h2>
            <div class="info-grid">
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">رقم المختبر:</span>
                        <span class="info-value">{{optional($all_data->test)->test_code_st}}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">تاريخ الطلب:</span>
                        <span class="info-value">{{optional($all_data->test)->talab_date}}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">عدد العينات:</span>
                        <span class="info-value">{{optional($all_data->test)->sample_number}}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">رقم الصادر:</span>
                        <span class="info-value">{{optional(optional($all_data->test)->sader)->num}}</span>
                    </div>
                </div>
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">رقم الكتاب:</span>
                        <span class="info-value">{{optional($all_data->test)->book_number}}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">رقم الطلب:</span>
                        <span class="info-value">{{optional($all_data->test)->talab_number}}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">تاريخ الصادر:</span>
                        <span class="info-value">{{optional(optional($all_data->test)->sader)->date}}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Information -->
        <div class="info-section">
            <h2>معلومات العميل</h2>
            <div class="info-grid">
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">العميل:</span>

                        <span class="info-value">{{optional(optional($all_data->test)->client)->name}}</span>


                    </div>
                    <div class="info-row">
                        <span class="info-label">المشروع:</span>

                        <span
                            class="info-value">{{optional(optional($all_data->test)->project)->project_name}}</span>

                    </div>
                </div>
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">الشركة:</span>

                        <span
                            class="info-value">{{optional(optional($all_data->test)->company)->name}}</span>

                    </div>

                </div>
            </div>
        </div>

        <!-- Invoice Table -->
        <div class="invoice-table-section">
            <h2>تفاصيل الفاتورة</h2>
            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>قرم الفاتورة</th>
                        <th>تاريخ الدفع</th>
                        <th class="amount-column">المبلغ</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $totalPayment = 0;
                    @endphp

                    @foreach($all_data->client_test_payment as $pay)
                        @php
                            $totalPayment += $pay->value;
                        @endphp
                        <tr>
                            <td>{{ 'INV-' . $pay->num }}</td>
                            <td>{{ $pay->paid_date }}</td>
                            <td class="amount-column">دينار{{ number_format($pay->value, 2) }}</td>
                        </tr>
                    @endforeach

                    <tr class="total-row">
                        <td colspan="2" class="text-right">المجموع:</td>
                        <td class="amount-column bold">دينار{{ number_format($totalPayment, 2) }}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-content">
                <div class="footer-left">
                    <p>شكراً لتعاملكم معنا</p>
                </div>
                <div class="footer-right">
                    <div id="issue-date">تاريخ الإصدار:</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set the current date in Arabic format
        const today = new Date();
        const options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric'
        };
        const arabicDate = today.toLocaleDateString('ar-SA', options);
        document.getElementById('issue-date').textContent += arabicDate;

        // Print button functionality
        const printButton = document.getElementById('printButton');
        printButton.addEventListener('click', function () {
            // Apply print optimizations
            document.body.classList.add('printing');

            // Small delay to ensure styles are applied
            setTimeout(function () {
                window.print();

                // Remove print-specific class after printing
                setTimeout(function () {
                    document.body.classList.remove('printing');
                }, 500);
            }, 100);
        });

        // Handle print media change to restore normal view after printing
        window.matchMedia('print').addEventListener('change', function (mql) {
            if (!mql.matches) {
                // Print dialog closed
                document.body.classList.remove('printing');
            }
        });
    });
</script>
</body>
</html>
