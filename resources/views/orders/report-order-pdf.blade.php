<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Smaller font size for better fit */
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px; /* Consistent font size for shop name */
            font-weight: bold;
        }
        .header p {
            margin: 2px 0;
            font-size: 15px; /* Smaller font size for shop address and description */
        }
        .report-title {
            text-align: center;
            margin-bottom: 10px;
            font-size: 16px; /* Consistent font size for report title */
            font-weight: bold;
        }
        .summary {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 4px; /* Smaller padding for better fit */
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 10px; /* Smaller font size for headers */
        }
        td {
            font-size: 9px; /* Smaller font size for table data */
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 8px;
            color: #666;
        }
        .page-break {
            page-break-after: always; /* Ensure page breaks */
        }
        footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $shopDetails['name'] }}</h1>
        <p>{{ $shopDetails['address'] }}</p>
        <p>{{ $shopDetails['phone_number'] }}</p>
        <p>{{ $shopDetails['description'] }}</p>
    </div>

    <!-- Report Title -->
    <div class="report-title">Sales Report</div>

    <p>Start Date: {{ $start_date }}</p>
    <p>End Date: {{ $end_date }}</p>

    <div class="summary">
        <p><strong>Total Sales:</strong> <strong>Kshs {{ number_format($totalSales, 2) }}</strong></p>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Total Cost</th>
                <!-- <th>Payment Method</th> -->
                <!-- <th>Created By</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->invoice_no }}</td>
                    <td>{{ $order->updated_at }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->unitcost, 2) }}</td>
                    <td>{{ number_format($order->total, 2) }}</td>
                    <!-- <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_by }}</td> -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Report generated on: {{ $reportTime }}
    </div>

    <!-- Pagination -->
    <div class="page-break"></div>
</body>
</html>