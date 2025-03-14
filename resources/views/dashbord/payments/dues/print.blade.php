<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->num }}</title>
    <style>
        .invoice-container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-info img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .company-info h3 {
            margin-bottom: 0;
            line-height: normal;
        }
        .company-info h3 span {
            color: orange;
        }
        .company-info p {
            margin-bottom: 0;
            line-height: normal;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="invoice-container print-content">
    <!-- Company Header -->
    <div class="company-info">
        <!-- Logo -->
        <img src="{{ asset('images/' . get_print_image()) }}" alt="Company Logo">

        <!-- Header Data -->
        <h3 style="margin-bottom: 0; line-height: normal;">
            <span style="color: orange;">ALSHARQ</span> TESTS LABORATORY
        </h3>
        <p style="margin-bottom: 0; line-height: normal;">
            Registration No. under Iraqi accreditation system is (124)
        </p>
        <p style="margin-bottom: 0; line-height: normal;">
            Registration No. under Iraqi Engineer Union is (508)
        </p>
    </div>

    <!-- Invoice Header -->
    <div class="invoice-header">
        <h1>Invoice #{{ $invoice->num }}</h1>
    </div>

    <!-- Invoice Details -->
    <div class="invoice-details">
        <p><strong>Date:</strong> {{ $invoice->paid_date }}</p>
        <p><strong>Customer:</strong> ss</p>
        <p><strong>Payment Type:</strong> {{ $invoice->payment_type }}</p>
    </div>

    <!-- Invoice Table -->
    <table class="invoice-table">
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td style="text-align: center">{{ $invoice->notes }}</td>
            <td style="text-align: center">{{ $invoice->value }}</td>
        </tr>
    </table>

    <!-- Invoice Footer -->
    <div class="invoice-footer">
        <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d H:i:s') }}</p>
    </div>
</div>
</body>
</html>
