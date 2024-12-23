<!DOCTYPE html>
<html>
<head>
    <title>Products Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>
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
</body>
</html>
