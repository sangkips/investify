@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    {{ __('Dashboard') }}
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('orders.create') }}" class="btn btn-success add-list mx-1 rounded d-none d-sm-inline">
                        Create new order
                    </a>
                    <a href="{{ route('orders.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                        <x-icon.plus />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total customers</div>
                            <div class="ms-auto lh-1">
                                @if($customerGrowth >= 0)
                                    <span class="text-green d-inline-flex align-items-center lh-1">+{{ number_format($customerGrowth, 1) }}%</span>
                                @else
                                    <span class="text-red d-inline-flex align-items-center lh-1">{{ number_format($customerGrowth, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ number_format($customers) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total revenue</div>
                            <div class="ms-auto lh-1">
                                @if($revenueGrowth >= 0)
                                    <span class="text-green d-inline-flex align-items-center lh-1">+{{ number_format($revenueGrowth, 1) }}%</span>
                                @else
                                    <span class="text-red d-inline-flex align-items-center lh-1">{{ number_format($revenueGrowth, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">KES {{ number_format($totalRevenue, 2) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total orders</div>
                            <div class="ms-auto lh-1">
                                @if($orderGrowth >= 0)
                                    <span class="text-green d-inline-flex align-items-center lh-1">+{{ number_format($orderGrowth, 1) }}%</span>
                                @else
                                    <span class="text-red d-inline-flex align-items-center lh-1">{{ number_format($orderGrowth, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ number_format($orders) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total Purchases</div>
                            <div class="ms-auto lh-1">
                                @if($purchaseGrowth >= 0)
                                    <span class="text-green d-inline-flex align-items-center lh-1">+{{ number_format($purchaseGrowth, 1) }}%</span>
                                @else
                                    <span class="text-red d-inline-flex align-items-center lh-1">{{ number_format($purchaseGrowth, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">KES {{ number_format($totalPurchases, 2) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Product sales</div>
                        <div id="chart-product-sales" class="chart-lg"></div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Sales by product category</div>
                        <div id="chart-sales-category" class="chart-lg"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Latest transactions</div>
                        <table class="table table-vcenter card-table">
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
                                    <td><span class="badge bg-green">Complete</span></td>
                                    <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No transactions found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-libraries')
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
@endpush

@pushonce('page-scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-product-sales'), {
            chart: { type: "bar", fontFamily: 'inherit', height: 300 },
            series: [
                { name: "Orders", data: @json($salesChartData) },
                { name: "Revenue (KES)", data: @json($revenueChartData) }
            ],
            xaxis: { categories: @json($chartDates) },
            colors: ['#1E90FF', '#FFA500']
        })).render();
    });

    document.addEventListener("DOMContentLoaded", function() {
        @if(!empty($categoryLabels))
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-sales-category'), {
            chart: { type: "pie", fontFamily: 'inherit', height: 300 },
            series: @json($categoryValues),
            labels: @json($categoryLabels),
            colors: ['#8A4AF3', '#FF6347', '#FFD700', '#ADFF2F', '#20B2AA', '#BA55D3', '#CD5C5C', '#9ACD32', '#00CED1', '#DAA520']
        })).render();
        @endif
    });
</script>
@endpushonce