<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1e1b4b;
            line-height: 1.4;
            padding: 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e1b4b;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1e1b4b;
            margin-bottom: 4px;
        }

        .header .address {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 2px;
        }

        .header .description {
            font-size: 10px;
            color: #64748b;
            font-style: italic;
        }

        /* Report Title */
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title h2 {
            font-size: 16px;
            font-weight: 700;
            color: #1e1b4b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Table Section */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #1e1b4b;
        }

        thead tr {
            background-color: #1e1b4b !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        th {
            color: #ffffff !important;
            background-color: #1e1b4b !important;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 8px;
            text-align: left;
            border: 1px solid #1e1b4b;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5),
        th:nth-child(6) {
            text-align: right;
        }

        th:last-child {
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        td {
            padding: 10px 8px;
            font-size: 10px;
            color: #1e1b4b;
            vertical-align: middle;
            border: 1px solid #e2e8f0;
        }

        td:nth-child(3),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6) {
            text-align: right;
        }

        td:last-child {
            text-align: center;
        }

        .product-code {
            font-weight: 600;
            color: #312e81;
        }

        .product-name {
            font-weight: 500;
        }

        .quantity {
            font-weight: 600;
            color: #2563eb;
        }

        .buying-price {
            color: #64748b;
        }

        .selling-price {
            font-weight: 600;
            color: #22c55e;
        }

        .tax {
            color: #f59e0b;
            font-weight: 500;
        }

        .date-added {
            color: #64748b;
            font-size: 9px;
        }

        /* Summary Section */
        .summary {
            margin-top: 15px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-size: 11px;
            color: #64748b;
        }

        .summary-value {
            font-size: 11px;
            font-weight: 600;
            color: #1e1b4b;
        }

        /* Footer Section */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .footer p {
            font-size: 9px;
            color: #94a3b8;
        }

        /* Page settings for PDF */
        @page {
            margin: 15mm;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $name }}</h1>
        <p class="address">{{ $address }}</p>
        <p class="description">{{ $description }}</p>
    </div>

    <!-- Report Title -->
    <div class="report-title">
        <h2>Products Report</h2>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Current Stock</th>
                <th>Buying Price (KES)</th>
                <th>Selling Price (KES)</th>
                <th>Tax Rate</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalStock = 0;
                $totalBuyingValue = 0;
                $totalSellingValue = 0;
            @endphp
            @foreach ($products as $product)
                @php
                    $totalStock += $product['quantity'] ?? 0;
                    $totalBuyingValue += ($product['buying_price'] ?? 0) * ($product['quantity'] ?? 0);
                    $totalSellingValue += ($product['selling_price'] ?? 0) * ($product['quantity'] ?? 0);
                @endphp
                <tr>
                    <td class="product-code">{{ $product['code'] }}</td>
                    <td class="product-name">{{ $product['name'] }}</td>
                    <td class="quantity">{{ $product['quantity'] }}</td>
                    <td class="buying-price">{{ number_format($product['buying_price'] ?? 0, 2) }}</td>
                    <td class="selling-price">{{ number_format($product['selling_price'] ?? 0, 2) }}</td>
                    <td class="tax">{{ $product['tax'] ?? 0 }}%</td>
                    <td class="date-added">{{ \Carbon\Carbon::parse($product['created_at'])->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Products:</span>
            <span class="summary-value">{{ count($products) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Stock:</span>
            <span class="summary-value">{{ number_format($totalStock) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Stock Value (Cost):</span>
            <span class="summary-value">KES {{ number_format($totalBuyingValue, 2) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Stock Value (Retail):</span>
            <span class="summary-value">KES {{ number_format($totalSellingValue, 2) }}</span>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Report Generated On: {{ now()->format('d M Y, H:i:s') }}</p>
    </div>
</body>
</html>
