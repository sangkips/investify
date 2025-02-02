<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Breakdown Report</title>
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
    <div class="header">
        <h1>{{ $name }}</h1>
        <p><strong>{{ $address }}</strong></p>
        <p><strong>{{ $description }}</strong></p>
    </div>
    <div class="report-title">Monthly Breakdown Report for {{ $year }}</div>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Sales</th>
                    <!-- <th>Total Orders</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($monthlySales as $data)
                    <tr>
                        <td>{{ $data['month'] }}</td>
                        <td>KES {{ number_format($data['total_sales'], 2) }}</td>
                        <!-- <td>{{ $data['total_orders'] }}</td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    <footer>
        <div class="footer">
            Report generated on: {{ now()->format('Y-m-d H:i:s') }}
        </div>
    </footer>

    <!-- Pagination -->
    <div class="page-break"></div>
</body>
</html>
