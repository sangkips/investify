<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>
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
            font-size: 18px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $name }}</h1>
        <p><strong>{{ $address }}</strong></p>
        <p><strong>{{ $description }}</strong></p>
    </div>
  
    <!-- Report Title -->
    <div class="report-title">Purchase Report</div>

    <p>Start Date: {{ $start_date }}</p>
    <p>End Date: {{ $end_date }}</p>

    <!-- Table Section -->
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
            <th>Total Cost (KES)</th>
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
                    <td><strong>{{ $purchase->purchase_total }}</strong></td>
                    <!-- <td>{{ $purchase->created_by }}</td> -->
                </tr>
            @endforeach
        </tbody>
    </table> 

    <!-- Footer Section -->
    <footer>
        <div class="footer">
            <p>Report Generated On: {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </footer>

    <!-- Pagination -->
    <div class="page-break"></div>
</body>
</html>