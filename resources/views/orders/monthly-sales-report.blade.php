<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Breakdown Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
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
    <div class="container">
        <h1>Monthly Breakdown Report for {{ $year }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Sales</th>
                    <th>Total Orders</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monthlySales as $data)
                    <tr>
                        <td>{{ $data['month'] }}</td>
                        <td>KES {{ number_format($data['total_sales'], 2) }}</td>
                        <td>{{ $data['total_orders'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <footer>
        Generated on {{ now()->format('Y-m-d H:i:s') }}
    </footer>
</body>
</html>
