<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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

        .header .phone {
            font-size: 11px;
            color: #1e1b4b;
            font-weight: 600;
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

        /* Date Range */
        .date-range {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .date-range p {
            font-size: 10px;
            color: #64748b;
        }

        .date-range strong {
            color: #1e1b4b;
        }

        /* Total Sales Highlight */
        .total-highlight {
            margin-bottom: 15px;
            padding: 12px 15px;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border-radius: 6px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-highlight .label {
            font-size: 12px;
            font-weight: 600;
        }

        .total-highlight .value {
            font-size: 16px;
            font-weight: 700;
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

        th:nth-child(5),
        th:nth-child(6),
        th:nth-child(7) {
            text-align: right;
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

        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(7) {
            text-align: right;
        }

        .invoice-no {
            font-weight: 600;
            color: #312e81;
        }

        .customer-name {
            font-weight: 500;
        }

        .product-name {
            max-width: 150px;
        }

        .quantity {
            font-weight: 600;
            color: #2563eb;
        }

        .unit-cost {
            color: #64748b;
        }

        .total-cost {
            font-weight: 700;
            color: #22c55e;
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
            padding-top: 10px;
            margin-top: 5px;
            border-top: 2px solid #1e1b4b;
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

        .summary-row:last-child .summary-label {
            font-size: 12px;
            font-weight: 600;
            color: #1e1b4b;
        }

        .summary-row:last-child .summary-value {
            font-size: 14px;
            font-weight: 700;
            color: #22c55e;
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
        <h1>{{ $shopDetails['name'] }}</h1>
        <p class="address">{{ $shopDetails['address'] }}</p>
        <p class="phone">{{ $shopDetails['phone_number'] }}</p>
        <p class="description">{{ $shopDetails['description'] }}</p>
    </div>

    <!-- Report Title -->
    <div class="report-title">
        <h2>Sales Report</h2>
    </div>

    <!-- Date Range -->
    <div class="date-range">
        <p><strong>Start Date:</strong> {{ $start_date }}</p>
        <p><strong>End Date:</strong> {{ $end_date }}</p>
    </div>

    <!-- Total Sales Highlight -->
    <div class="total-highlight">
        <span class="label">Total Sales Revenue</span>
        <span class="value">KES {{ number_format($totalSales, 2) }}</span>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Sale Date</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Quantity Sold</th>
                <th>Unit Price (KES)</th>
                <th>Total Amount (KES)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalItems = 0;
                $totalTransactions = count($orders);
            @endphp
            @foreach($orders as $order)
                @php
                    $totalItems += $order->quantity ?? 0;
                @endphp
                <tr>
                    <td class="invoice-no">{{ $order->invoice_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d M Y') }}</td>
                    <td class="customer-name">{{ $order->customer_name }}</td>
                    <td class="product-name">{{ $order->name }}</td>
                    <td class="quantity">{{ $order->quantity }}</td>
                    <td class="unit-cost">{{ number_format($order->unitcost ?? 0, 2) }}</td>
                    <td class="total-cost">{{ number_format($order->total ?? 0, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Items Sold:</span>
            <span class="summary-value">{{ number_format($totalItems) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Transactions:</span>
            <span class="summary-value">{{ $totalTransactions }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Grand Total (KES):</span>
            <span class="summary-value">{{ number_format($totalSales, 2) }}</span>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Report Generated On: {{ now()->format('d M Y, H:i:s') }}</p>
    </div>
</body>
</html>