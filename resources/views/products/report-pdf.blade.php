<!DOCTYPE html>
<html>
<head>
    <title>Products Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
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

        .text-center {
            text-align: center;
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
    <!-- <div class="report-title">Purchase Report</div> -->
    <h2 class="text-center">Products Report</h2>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Quantity Alert</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Tax</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['code'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['quantity_alert'] }}</td>
                    <td>{{ $product['buying_price'] }}</td>
                    <td>{{ $product['selling_price'] }}</td>
                    <td>{{ $product['tax'] }}</td>
                    <td>{{ $product['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <div class="footer">
            <p>Report Generated On: {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </footer>

    <!-- Pagination -->
    <div class="page-break"></div>
</body>
</html>
