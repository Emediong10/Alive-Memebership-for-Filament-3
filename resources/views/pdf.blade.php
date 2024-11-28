<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        .receipt-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-header img {
            max-width: 120px;
        }
        .receipt-header h1 {
            margin: 10px 0;
            font-size: 28px;
            color: #343a40;
        }
        .info-table, .summary-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            padding: 10px;
            text-align: left;
        }
        .info-table th {
            background: #f1f1f1;
        }
        .summary-table th, .summary-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .summary-table th {
            background: #f1f1f1;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            color: #343a40;
        }
        .receipt-footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 30px;
        }
        .btn-download {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
@php
      $user = auth()->user();
@endphp

    <div class="receipt-container">
        <div class="receipt-header">
            <img src="assets/images/Aliveng.png" alt="Company Logo">
            <h1>Payment Receipt</h1>
        </div>

        <table class="info-table">
            <tr>
                <th>Name:</th>
                <td>{{ $user->name }}</td>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Payment ID:</th>
                <td>{{ $record->trans_reference }}</td>
                <th>Payment Date:</th>
                <td>{{\Carbon\Carbon::parse($record->created_at)->format('M d Y') }}</td>
            </tr>
        </table>

        <table class="table table-striped summary-table">
            <thead>
                <tr>
                    {{-- <th>Item</th> --}}
                    <th>Description</th>
                    <th>Transaction Status</th>
                    {{-- <th>Unit Price</th> --}}
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- <td>Product A</td> --}}
                    <td> {{ $record->description }}</td>
                    <td> {{ $record->trans_status }}<</td>
                    {{-- <td>$50.00</td> --}}
                    <td> {{Number::currency($record->amount / 100, 'NGN') }}</td>
                </tr>
              
            </tbody>
            
        </table>


        <div class="receipt-footer">
            <p>Thank you for your generous support</p>
            <p>Email:alivenigeria2011@gmail.com</p>
        </div>

        <div class="btn-download">
            <a href="#" class="btn btn-success">Download Receipt</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
