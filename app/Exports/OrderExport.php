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
    public function collection()
    {
        return Order::all();
    }
}
