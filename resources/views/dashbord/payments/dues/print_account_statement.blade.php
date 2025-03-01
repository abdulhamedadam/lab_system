<!DOCTYPE html>
<html>
<head>
    <title>Invoice and Account Statement</title>
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
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
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




    <!-- Account Statement Section -->
    @php
        $totalPayment = $all_data->client_test_payment->sum('value');
    @endphp
    <div class="section-title">Account Statement</div>
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_data->client_test_payment as $pay)
            <tr>
                <td style="text-align: center">{{ 'INV-' . $pay->num }}</td>
                <td style="text-align: center">{{ $pay->paid_date }}</td>
                <td style="text-align: center">{{ number_format($pay->value, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" style="text-align: right; font-weight: bold;">Total:</td>
            <td style="text-align: center; font-weight: bold;">${{ number_format($totalPayment, 2) }}</td>
        </tr>
        </tfoot>
    </table>


    <!-- Invoice Footer -->
    <div class="invoice-footer">
        <p><strong>Date:</strong> {{ date('Y-m-d') }}</p>
    </div>
</div>
</body>
</html>
