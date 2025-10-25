<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic counts
        $orders = Order::count();
        $products = Product::count();
        $purchases = Purchase::count();
        $customers = Customer::count();
        
        // Calculate total revenue from completed orders (divide by 100 because amount is stored in cents)
        $totalRevenue = Order::where('order_status', 1)->sum(DB::raw('total / 100'));
        
        // Get revenue trend (compare this month with last month)
        $currentMonthRevenue = Order::where('order_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('total / 100'));
            
        $lastMonthRevenue = Order::where('order_status', 1)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum(DB::raw('total / 100'));
            
        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;
        
        // Get customers growth
        $thisMonthCustomers = Customer::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthCustomers = Customer::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
            
        $customerGrowth = $lastMonthCustomers > 0 
            ? (($thisMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 
            : 0;
        
        // Get orders growth
        $thisMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
            
        $orderGrowth = $lastMonthOrders > 0 
            ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 
            : 0;
        
        // Get sales data for last 12 days for chart
        $salesChartData = [];
        $dates = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('d M');
            $salesChartData[] = Order::whereDate('created_at', $date)
                ->where('order_status', 1)
                ->count();
        }
        
        // Get revenue for each day (divide by 100 because amount is stored in cents)
        $revenueChartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenueChartData[] = Order::whereDate('created_at', $date)
                ->where('order_status', 1)
                ->sum(DB::raw('total / 100'));
        }
        
        // Get sales by category (divide by 100 because amount is stored in cents)
        $categorySales = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.order_status', 1)
            ->select('categories.name as category_name', DB::raw('SUM(order_details.total / 100) as total_sales'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->get();
        
        $categoryLabels = $categorySales->pluck('category_name')->toArray();
        $categoryValues = $categorySales->pluck('total_sales')->map(function($value) {
            return (float) $value;
        })->toArray();
        
        // Get latest transactions
        $latestTransactions = Order::with('customer')
            ->where('order_status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'customer_id', 'invoice_no', 'total', 'created_at', 'order_status']);
        
        // Additional data
        $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
        $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
        $totalPurchases = Purchase::sum('total_amount');
        $todayCustomers = Customer::whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
        
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $totalOrdersToday = Order::whereDate('created_at', Carbon::today())->sum(DB::raw('total / 100'));
        
        // Purchase growth
        $thisMonthPurchases = Purchase::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $lastMonthPurchases = Purchase::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
            
        $purchaseGrowth = $lastMonthPurchases > 0 
            ? (($thisMonthPurchases - $lastMonthPurchases) / $lastMonthPurchases) * 100 
            : 0;

        return view('dashboard', [
            'products' => $products,
            'orders' => $orders,
            'totalRevenue' => $totalRevenue,
            'revenueGrowth' => $revenueGrowth,
            'customerGrowth' => $customerGrowth,
            'orderGrowth' => $orderGrowth,
            'purchaseGrowth' => $purchaseGrowth,
            'salesChartData' => $salesChartData,
            'revenueChartData' => $revenueChartData,
            'chartDates' => $dates,
            'categoryLabels' => $categoryLabels,
            'categoryValues' => $categoryValues,
            'latestTransactions' => $latestTransactions,
            'totalOrdersToday' => $totalOrdersToday,
            'purchases' => $purchases,
            'customers' => $customers,
            'totalPurchases' => $totalPurchases,
            'todayPurchases' => $todayPurchases,
            'todayProducts' => $todayProducts,
            'todayCustomers' => $todayCustomers,
            'todayQuotations' => $todayQuotations,
            'todayOrders' => $todayOrders,
        ]);
    }
}
