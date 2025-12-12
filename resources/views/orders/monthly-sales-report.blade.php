<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Breakdown Report</title>
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

        .report-title .year-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 16px;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
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
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 12px;
            text-align: left;
            border: 1px solid #1e1b4b;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        th:last-child {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        td {
            padding: 12px;
            font-size: 11px;
            color: #1e1b4b;
            vertical-align: middle;
            border: 1px solid #e2e8f0;
        }

        td:last-child {
            text-align: right;
        }

        .month-name {
            font-weight: 600;
            color: #312e81;
        }

        .sales-amount {
            font-weight: 700;
            color: #22c55e;
            font-size: 12px;
        }

        /* Summary Section */
        .summary {
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            border-radius: 10px;
            color: white;
        }

        .summary-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .summary-grid {
            display: flex;
            justify-content: space-between;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .label {
            font-size: 10px;
            opacity: 0.7;
            margin-bottom: 4px;
        }

        .summary-item .value {
            font-size: 18px;
            font-weight: 700;
        }

        .summary-item .value.highlight {
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
        <h2>Monthly Sales Breakdown Report</h2>
        <span class="year-badge">Year {{ $year }}</span>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Total Sales Revenue (KES)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $highestMonth = null;
                $highestSales = 0;
                $lowestMonth = null;
                $lowestSales = PHP_INT_MAX;
            @endphp
            @foreach ($monthlySales as $data)
                @php
                    $grandTotal += $data['total_sales'];
                    if ($data['total_sales'] > $highestSales) {
                        $highestSales = $data['total_sales'];
                        $highestMonth = $data['month'];
                    }
                    if ($data['total_sales'] < $lowestSales && $data['total_sales'] > 0) {
                        $lowestSales = $data['total_sales'];
                        $lowestMonth = $data['month'];
                    }
                @endphp
                <tr>
                    <td class="month-name">{{ $data['month'] }}</td>
                    <td class="sales-amount">KES {{ number_format($data['total_sales'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary">
        <div class="summary-title">Annual Summary</div>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="label">Total Annual Sales</div>
                <div class="value highlight">KES {{ number_format($grandTotal, 2) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Monthly Average</div>
                <div class="value">KES {{ number_format($grandTotal / 12, 2) }}</div>
            </div>
            @if($highestMonth)
            <div class="summary-item">
                <div class="label">Best Month</div>
                <div class="value">{{ $highestMonth }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Report Generated On: {{ now()->format('d M Y, H:i:s') }}</p>
    </div>
</body>
</html>
