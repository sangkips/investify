<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1 class="title">Sales Report</h1>
    <p>Start Date: {{ $start_date }}</p>
    <p>End Date: {{ $end_date }}</p>

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
                <th>Payment Method</th>
                <th>Created By</th>
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
                    <td>{{ $order->unitcost }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_by }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
