<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>
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

        th:last-child,
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

        td:last-child,
        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(7) {
            text-align: right;
        }

        .purchase-no {
            font-weight: 600;
            color: #312e81;
        }

        .supplier-name {
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
        <h1>{{ $name }}</h1>
        <p class="address">{{ $address }}</p>
        <p class="description">{{ $description }}</p>
    </div>

    <!-- Report Title -->
    <div class="report-title">
        <h2>Purchase Report</h2>
    </div>

    <!-- Date Range -->
    <div class="date-range">
        <p><strong>Start Date:</strong> {{ $start_date }}</p>
        <p><strong>End Date:</strong> {{ $end_date }}</p>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Purchase Code</th>
                <th>Purchase Date</th>
                <th>Supplier Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Cost (KES)</th>
                <th>Total Cost (KES)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $totalItems = 0;
            @endphp
            @foreach($purchases as $purchase)
                @php
                    $grandTotal += $purchase->purchase_total ?? 0;
                    $totalItems += $purchase->quantity ?? 0;
                @endphp
                <tr>
                    <td class="purchase-no">{{ $purchase->purchase_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($purchase->updated_at)->format('d M Y') }}</td>
                    <td class="supplier-name">{{ $purchase->supplier_name }}</td>
                    <td class="product-name">{{ $purchase->name }}</td>
                    <td class="quantity">{{ $purchase->quantity }}</td>
                    <td class="unit-cost">{{ number_format($purchase->unitcost ?? 0, 2) }}</td>
                    <td class="total-cost">{{ number_format($purchase->purchase_total ?? 0, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Items Purchased:</span>
            <span class="summary-value">{{ $totalItems }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Transactions:</span>
            <span class="summary-value">{{ count($purchases) }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Grand Total (KES):</span>
            <span class="summary-value">{{ number_format($grandTotal, 2) }}</span>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Report Generated On: {{ now()->format('d M Y, H:i:s') }}</p>
    </div>
</body>
</html>