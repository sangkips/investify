<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchaseExport implements FromCollection
{
    protected $purchases;

    public function __construct(Collection $purchases)
    {
        $this->purchases = $purchases;
    }
    public function collection()
    {
        return Purchase::all();
    }
}
