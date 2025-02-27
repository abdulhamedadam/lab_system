<!DOCTYPE html>
<html>
<head>

    <title>Invoice #{{ $invoice->num }}</title>
    <style>
        /* Add your invoice print styles here */
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
    </style>
</head>
<body>
<div class="invoice-container print-content">
    <div class="invoice-header">
        <h1>Invoice #{{ $invoice->num }}</h1>
    </div>
    <div class="invoice-details">
        <p><strong>Date:</strong> {{ $invoice->paid_date }}</p>
        <p><strong>Customer:</strong> ss</p>
        <p><strong>Payment Type:</strong> {{ $invoice->payment_type }}</p>
    </div>
    <table class="invoice-table">
        <tr>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Payment</td>
            <td>{{ $invoice->value }}</td>
        </tr>
    </table>
    <div class="invoice-footer">
        <p><strong>Created by:</strong> 1</p>
        <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d H:i:s') }}</p>
    </div>
</div>
</body>
</html>
