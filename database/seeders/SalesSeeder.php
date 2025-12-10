<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates sales records for the past 5 days
     */
    public function run(): void
    {
        // Get existing data
        $customer = Customer::first();
        $products = Product::all();
        $user = User::first();

        if (!$customer || $products->isEmpty() || !$user) {
            $this->command->error('Please ensure you have at least one customer, product, and user in the database.');
            return;
        }

        // Generate orders for the past 5 days
        $today = Carbon::today();
        
        for ($daysAgo = 0; $daysAgo < 5; $daysAgo++) {
            $orderDate = $today->copy()->subDays($daysAgo);
            
            // Create 2-4 orders per day
            $ordersPerDay = rand(2, 4);
            
            for ($i = 0; $i < $ordersPerDay; $i++) {
                // Random number of products per order (1-3)
                $numProducts = rand(1, min(3, $products->count()));
                $selectedProducts = $products->random($numProducts);
                
                // Calculate order totals (in cents for storage)
                $subTotal = 0;
                $totalProducts = 0;
                $orderDetails = [];
                
                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 5);
                    $unitCost = $product->selling_price * 100; // Convert to cents
                    $productTotal = $unitCost * $quantity;
                    
                    $subTotal += $productTotal;
                    $totalProducts += $quantity;
                    
                    $orderDetails[] = [
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unitcost' => $unitCost,
                        'total' => $productTotal,
                    ];
                }
                
                // Calculate VAT (16%)
                $vat = (int) ($subTotal * 0.16);
                $total = $subTotal + $vat;
                
                // Generate invoice number
                $invoicePrefix = 'INV-' . $orderDate->format('Ymd');
                $existingCount = Order::where('invoice_no', 'like', $invoicePrefix . '%')->count();
                $invoiceNo = $invoicePrefix . '-' . str_pad($existingCount + 1, 4, '0', STR_PAD_LEFT);
                
                // Payment types
                $paymentTypes = ['Cash', 'Card', 'Mpesa'];
                $paymentType = $paymentTypes[array_rand($paymentTypes)];
                
                // Some orders are fully paid, some have due amounts
                $isPaid = rand(0, 10) > 2; // 80% fully paid
                $pay = $isPaid ? $total : (int) ($total * (rand(50, 90) / 100));
                $due = $total - $pay;
                
                // Order status: mostly complete
                $orderStatus = rand(0, 10) > 1 ? 1 : 0; // 90% complete
                
                // Create the order
                $order = Order::create([
                    'uuid' => Str::uuid(),
                    'user_id' => $user->id,
                    'customer_id' => $customer->id,
                    'order_date' => $orderDate->format('Y-m-d'),
                    'order_status' => $orderStatus,
                    'total_products' => $totalProducts,
                    'sub_total' => $subTotal,
                    'vat' => $vat,
                    'total' => $total,
                    'invoice_no' => $invoiceNo,
                    'payment_type' => $paymentType,
                    'pay' => $pay,
                    'due' => $due,
                    'created_at' => $orderDate->copy()->addHours(rand(8, 18))->addMinutes(rand(0, 59)),
                    'updated_at' => $orderDate->copy()->addHours(rand(8, 18))->addMinutes(rand(0, 59)),
                ]);
                
                // Create order details
                foreach ($orderDetails as $detail) {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $detail['product_id'],
                        'quantity' => $detail['quantity'],
                        'unitcost' => $detail['unitcost'],
                        'total' => $detail['total'],
                    ]);
                }
            }
            
            $this->command->info("Created {$ordersPerDay} orders for " . $orderDate->format('Y-m-d'));
        }
        
        $this->command->info('Sales seeding completed!');
    }
}
