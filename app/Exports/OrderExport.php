<?php

namespace App\Exports;

use App\Models\Order;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    protected $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    // Map the data to individual rows in the Excel file
    public function map($order): array
    {
        return [
            $order->updated_at,
            $order->customer_name,
            $order->name, // Product name
            $order->quantity,
            $order->unitcost,
            $order->total,
            $order->created_by,
        ];
    }

    // Return the headings for the columns
    public function headings(): array
    {
        return [
            'Order Date',
            'Customer Name',
            'Product Name',
            'Quantity',
            'Unit Cost',
            'Total',
            'Created By',
        ];
    }
    public function collection()
    {
        return Order::all();
    }
}
