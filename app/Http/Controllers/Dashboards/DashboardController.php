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
        $orders = Order::where("user_id", auth()->id())->count();
        $products = Product::where("user_id", auth()->id())->count();

        $purchases = Purchase::where("user_id", auth()->id())->count();
        $customers = Customer::where("user_id", auth()->id())->count();
        $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
        $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
        $totalPurchases = Purchase::where("user_id", auth()->id())->sum('total_amount');

        $todayCustomers = Customer::whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
        $last7DaysCustomers = Customer::whereDate('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->count();
        $last30DaysCustomers = Customer::whereDate('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])->count();

        // $todayOrders = Order::whereDate('created_at', today()->format('Y-m-d'))->count();
        // Orders made today
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        // Orders made in the last 7 days
        $last7DaysOrders = Order::whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->count();

        // Orders made in the last 30 days
        $last30DaysOrders = Order::whereBetween('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])->count();

        // Total sales for today
        $totalOrdersToday = Order::where("user_id", auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        // Total sales for today
        $totalOrdersToday = Order::where("user_id", auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->sum('total');
        // Total sales for the last 7 days
        $totalOrdersLast7Days = Order::where("user_id", auth()->id())
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->sum('total');

        // Total sales for the last 30 days
        $totalOrdersLast30Days = Order::where("user_id", auth()->id())
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->sum('total');

        $categories = Category::where("user_id", auth()->id())->count();
        $quotations = Quotation::where("user_id", auth()->id())->count();

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
