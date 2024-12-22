<!DOCTYPE html>
<html>
<head>
    <title>Purchase Report</title>
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
    <h1 class="title">Purchase Report</h1>
    <p>Start Date: {{ $start_date }}</p>
    <p>End Date: {{ $end_date }}</p>

    <table>
        <thead>
            <tr>
                <th>Purchase No</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Total Cost</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->purchase_no }}</td>
                    <td>{{ $purchase->updated_at }}</td>
                    <td>{{ $purchase->supplier_name }}</td>
                    <td>{{ $purchase->code }}</td>
                    <td>{{ $purchase->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->unitcost }}</td>
                    <td>{{ $purchase->purchase_total }}</td>
                    <td>{{ $purchase->created_by }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
