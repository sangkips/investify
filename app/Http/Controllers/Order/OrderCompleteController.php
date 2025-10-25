<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderCompleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        
        $allowedPerPage = [5, 10, 15, 20, 25];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 5;
        }
        
        $orders = Order::where('order_status', OrderStatus::COMPLETE)
            ->latest()
            ->with('customer')
            ->paginate($perPage)
            ->withQueryString();

        return view('orders.complete-orders', [
            'orders' => $orders,
            'perPage' => $perPage,
            'allowedPerPage' => $allowedPerPage
        ]);
    }
}
