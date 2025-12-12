@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Dashboard Custom Styles - Inspired by modern design with landing page colors */
    :root {
        --dash-primary: #1e1b4b;
        --dash-primary-light: #312e81;
        --dash-accent: #f97316;
        --dash-accent-light: #fdba74;
        --dash-success: #22c55e;
        --dash-success-light: #bbf7d0;
        --dash-danger: #ef4444;
        --dash-purple: #8b5cf6;
        --dash-blue: #3b82f6;
        --dash-pink: #ec4899;
        --dash-cyan: #06b6d4;
        --dash-bg-gradient-start: #fef3e2;
        --dash-bg-gradient-end: #e0e7ff;
    }

    .page-wrapper {
        background: linear-gradient(135deg, var(--dash-bg-gradient-start) 0%, var(--dash-bg-gradient-end) 100%);
        min-height: 100vh;
    }

    .page-body {
        padding: 1.5rem 0;
    }

    /* Dashboard Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dash-primary);
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
    }

    .stat-icon svg {
        width: 20px;
        height: 20px;
        stroke-width: 2;
    }

    .stat-icon.customers { background: var(--dash-success-light); color: var(--dash-success); }
    .stat-icon.revenue { background: #dbeafe; color: var(--dash-blue); }
    .stat-icon.orders { background: #fce7f3; color: var(--dash-pink); }
    .stat-icon.purchases { background: #ede9fe; color: var(--dash-purple); }

    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dash-primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-change {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8rem;
        font-weight: 500;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .stat-change.positive {
        background: var(--dash-success-light);
        color: var(--dash-success);
    }

    .stat-change.negative {
        background: #fee2e2;
        color: var(--dash-danger);
    }

    .stat-change svg {
        width: 14px;
        height: 14px;
    }

    /* Chart Cards */
    .chart-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-bottom: 1.5rem;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dash-primary);
        margin: 0;
    }

    .chart-legend {
        display: flex;
        gap: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: #64748b;
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .legend-dot.margin { background: var(--dash-success); }
    .legend-dot.revenue { background: var(--dash-accent); }

    /* Bottom Row */
    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    /* Category Sales */
    .category-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .category-content {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .category-list {
        flex: 1;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 0;
        font-size: 0.875rem;
        color: #475569;
    }

    .category-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
    }

    .category-chart {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    /* Transactions Table */
    .transactions-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .transactions-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transactions-table th {
        text-align: left;
        padding: 0.75rem 0.5rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        border-bottom: 1px solid #e2e8f0;
    }

    .transactions-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    .transactions-table tr:last-child td {
        border-bottom: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-badge.complete {
        background: var(--dash-success-light);
        color: var(--dash-success);
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #d97706;
    }

    /* Create Order Button */
    .btn-create-order {
        background: var(--dash-primary);
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-create-order:hover {
        background: var(--dash-primary-light);
        color: white;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .bottom-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .category-content {
            flex-direction: column;
        }
    }

    /* ApexCharts axis labels visibility fix */
    #chart-product-sales .apexcharts-xaxis-label,
    #chart-product-sales .apexcharts-yaxis-label {
        fill: #64748b !important;
        font-size: 11px !important;
        font-family: 'Inter', sans-serif !important;
    }

    #chart-product-sales .apexcharts-xaxis text,
    #chart-product-sales .apexcharts-yaxis text {
        fill: #64748b !important;
    }

    #chart-product-sales .apexcharts-text {
        fill: #64748b !important;
    }

    .apexcharts-xaxis-label tspan,
    .apexcharts-yaxis-label tspan {
        fill: #64748b !important;
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard</h1>
            <a href="{{ route('orders.create') }}" class="btn-create-order">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Create new order
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <!-- Total Customers -->
            <div class="stat-card">
                <div class="stat-icon customers">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="stat-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                    Total customers
                </div>
                <div class="stat-value">{{ number_format($customers) }}</div>
                @if($customerGrowth >= 0)
                    <span class="stat-change positive">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17l5-5 5 5M7 7l5 5 5-5"/>
                        </svg>
                        +{{ number_format($customerGrowth, 1) }}%
                    </span>
                @else
                    <span class="stat-change negative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 7l5 5 5-5M7 17l5-5 5 5"/>
                        </svg>
                        {{ number_format($customerGrowth, 1) }}%
                    </span>
                @endif
            </div>

            <!-- Total Revenue -->
            <div class="stat-card">
                <div class="stat-icon revenue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <path d="M12 17h.01"/>
                    </svg>
                </div>
                <div class="stat-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/>
                    </svg>
                    Total revenue
                </div>
                <div class="stat-value">KES {{ number_format($totalRevenue, 0) }}</div>
                @if($revenueGrowth >= 0)
                    <span class="stat-change positive">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17l5-5 5 5M7 7l5 5 5-5"/>
                        </svg>
                        +{{ number_format($revenueGrowth, 1) }}%
                    </span>
                @else
                    <span class="stat-change negative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 7l5 5 5-5M7 17l5-5 5 5"/>
                        </svg>
                        {{ number_format($revenueGrowth, 1) }}%
                    </span>
                @endif
            </div>

            <!-- Total Orders -->
            <div class="stat-card">
                <div class="stat-icon orders">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <div class="stat-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/>
                        <line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                    Total orders
                </div>
                <div class="stat-value">{{ number_format($orders) }}</div>
                @if($orderGrowth >= 0)
                    <span class="stat-change positive">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17l5-5 5 5M7 7l5 5 5-5"/>
                        </svg>
                        +{{ number_format($orderGrowth, 1) }}%
                    </span>
                @else
                    <span class="stat-change negative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 7l5 5 5-5M7 17l5-5 5 5"/>
                        </svg>
                        {{ number_format($orderGrowth, 1) }}%
                    </span>
                @endif
            </div>

            <!-- Total Purchases -->
            <div class="stat-card">
                <div class="stat-icon purchases">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
                <div class="stat-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8"/>
                    </svg>
                    Total Purchases
                </div>
                <div class="stat-value">KES {{ number_format($totalPurchases, 0) }}</div>
                @if($purchaseGrowth >= 0)
                    <span class="stat-change positive">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17l5-5 5 5M7 7l5 5 5-5"/>
                        </svg>
                        +{{ number_format($purchaseGrowth, 1) }}%
                    </span>
                @else
                    <span class="stat-change negative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 7l5 5 5-5M7 17l5-5 5 5"/>
                        </svg>
                        {{ number_format($purchaseGrowth, 1) }}%
                    </span>
                @endif
            </div>
        </div>

        <!-- Product Sales Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Daily Profit Margins vs Revenue</h3>
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-dot margin"></span>
                        Profit Margins
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot revenue"></span>
                        Revenue
                    </div>
                </div>
            </div>
            <div id="chart-product-sales" style="height: 320px;"></div>
        </div>

        <!-- Bottom Row: Category Sales & Transactions -->
        <div class="bottom-grid">
            <!-- Sales by Category -->
            <div class="category-card">
                <h3 class="chart-title" style="margin-bottom: 1.25rem;">Sales by product category</h3>
                <div class="category-content">
                    <div class="category-list">
                        @if(!empty($categoryLabels))
                            @php
                                $colors = ['#8b5cf6', '#ec4899', '#f97316', '#22c55e', '#06b6d4', '#3b82f6', '#eab308', '#ef4444', '#14b8a6', '#a855f7'];
                            @endphp
                            @foreach($categoryLabels as $index => $label)
                                <div class="category-item">
                                    <span class="category-dot" style="background: {{ $colors[$index % count($colors)] }};"></span>
                                    {{ $label }} - {{ isset($categoryValues[$index]) ? number_format($categoryValues[$index] / array_sum($categoryValues) * 100, 0) : 0 }}%
                                </div>
                            @endforeach
                        @else
                            <div class="category-item">No category data available</div>
                        @endif
                    </div>
                    <div class="category-chart">
                        <div id="chart-sales-category" style="height: 220px; width: 220px;"></div>
                    </div>
                </div>
            </div>

            <!-- Latest Transactions -->
            <div class="transactions-card">
                <h3 class="chart-title" style="margin-bottom: 1.25rem;">Latest transactions</h3>
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->invoice_no }}</td>
                            <td>KES {{ number_format($transaction->total, 2) }}</td>
                            <td>
                                @if($transaction->order_status->value == 1)
                                    <span class="status-badge complete">Complete</span>
                                @else
                                    <span class="status-badge pending">Pending</span>
                                @endif
                            </td>
                            <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #94a3b8;">No transactions found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-libraries')
<link rel="stylesheet" href="{{ asset('dist/libs/apexcharts/dist/apexcharts.css') }}">
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
@endpush

@pushonce('page-scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Product Sales Bar Chart
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-product-sales'), {
            chart: {
                type: "bar",
                fontFamily: 'Inter, sans-serif',
                height: 320,
                toolbar: { show: false },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            series: [
                { name: "Profit Margins (KES)", data: @json($salesChartData) },
                { name: "Revenue (KES)", data: @json($revenueChartData) }
            ],
            xaxis: {
                categories: @json($chartDates),
                labels: {
                    show: true,
                    style: {
                        colors: '#1e293b',
                        fontSize: '12px'
                    }
                },
                axisBorder: { show: true, color: '#e2e8f0' },
                axisTicks: { show: true, color: '#e2e8f0' }
            },
            yaxis: {
                show: true,
                labels: {
                    show: true,
                    style: {
                        colors: '#1e293b',
                        fontSize: '12px'
                    },
                    formatter: function(val) {
                        if (val >= 1000000) return (val / 1000000).toFixed(0) + ' M';
                        if (val >= 1000) return (val / 1000).toFixed(0) + ' K';
                        return val;
                    }
                },
                axisBorder: { show: true, color: '#e2e8f0' },
                axisTicks: { show: true, color: '#e2e8f0' }
            },
            colors: ['#22c55e', '#f97316'],
            plotOptions: {
                bar: {
                    columnWidth: '60%',
                    borderRadius: 6,
                    borderRadiusApplication: 'end'
                }
            },
            dataLabels: { enabled: false },
            grid: {
                borderColor: '#e2e8f0',
                strokeDashArray: 0,
                padding: {
                    left: 10,
                    right: 10,
                    bottom: 5
                },
                yaxis: { lines: { show: true } },
                xaxis: { lines: { show: false } }
            },
            legend: { show: false },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return 'KES ' + val.toLocaleString();
                    }
                }
            }
        })).render();

        // Category Pie Chart
        @if(!empty($categoryLabels))
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-sales-category'), {
            chart: {
                type: "donut",
                fontFamily: 'Inter, sans-serif',
                height: 220,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            series: @json($categoryValues),
            labels: @json($categoryLabels),
            colors: ['#8b5cf6', '#ec4899', '#f97316', '#22c55e', '#06b6d4', '#3b82f6', '#eab308', '#ef4444', '#14b8a6', '#a855f7'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: { show: false },
                            value: {
                                show: true,
                                fontSize: '18px',
                                fontWeight: 700,
                                color: '#1e1b4b',
                                formatter: function(val) {
                                    return 'KES ' + Number(val).toLocaleString();
                                }
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '12px',
                                color: '#64748b',
                                formatter: function(w) {
                                    return 'KES ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString();
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            stroke: { width: 0 },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return 'KES ' + val.toLocaleString();
                    }
                }
            }
        })).render();
        @endif
    });
</script>
@endpushonce