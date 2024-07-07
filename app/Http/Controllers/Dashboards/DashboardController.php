<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::count();
        $products = Product::count();
        $purchases = Purchase::count();
        $customers = Customer::count();
        $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
        $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
        $totalPurchases = Purchase::sum('total_amount');
        $todayCustomers = Customer::whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
        $last7DaysCustomers = Customer::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->count();
        $last30DaysCustomers = Customer::whereBetween('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])->count();

        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $last7DaysOrders = Order::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->count();
        $last30DaysOrders = Order::whereBetween('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])->count();

        $totalOrdersToday = Order::whereDate('created_at', Carbon::today())->sum('total');
        $totalOrdersLast7Days = Order::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])->sum('total');
        $totalOrdersLast30Days = Order::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->sum('total');

        $categories = Category::count();
        $quotations = Quotation::count();

        return view('dashboard', [
            'products' => $products,
            'orders' => $orders,
            'totalOrdersToday' => $totalOrdersToday,
            'totalOrdersLast7Days' => $totalOrdersLast7Days,
            'totalOrdersLast30Days' => $totalOrdersLast30Days,
            'last7DaysOrders' => $last7DaysOrders,
            'last30DaysOrders' => $last30DaysOrders,
            'todayOrders' => $todayOrders,
            'last7DaysCustomers' => $last7DaysCustomers,
            'last30DaysCustomers' => $last30DaysCustomers,
            'totalPurchases' => $totalPurchases,
            'purchases' => $purchases,
            'customers' => $customers,
            'todayPurchases' => $todayPurchases,
            'todayProducts' => $todayProducts,
            'todayCustomers' => $todayCustomers,
            'todayQuotations' => $todayQuotations,
            'todayOrders' => $todayOrders,
            'categories' => $categories,
            'quotations' => $quotations
        ]);
    }
}
