<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing categories and units, or create defaults
        $categoryIds = Category::pluck('id')->toArray();
        $unitIds = Unit::pluck('id')->toArray();

        // If no categories exist, create some
        if (empty($categoryIds)) {
            $categories = [
                ['name' => 'Tools', 'slug' => 'tools', 'user_id' => 1],
                ['name' => 'Building Materials', 'slug' => 'building-materials', 'user_id' => 1],
                ['name' => 'Plumbing', 'slug' => 'plumbing', 'user_id' => 1],
                ['name' => 'Electrical', 'slug' => 'electrical', 'user_id' => 1],
                ['name' => 'Paint & Finishes', 'slug' => 'paint-finishes', 'user_id' => 1],
            ];
            foreach ($categories as $category) {
                Category::create($category);
            }
            $categoryIds = Category::pluck('id')->toArray();
        }

        // If no units exist, create some
        if (empty($unitIds)) {
            $units = [
                ['name' => 'Pieces', 'slug' => 'pieces', 'short_code' => 'pcs', 'user_id' => 1],
                ['name' => 'Kilograms', 'slug' => 'kilograms', 'short_code' => 'kg', 'user_id' => 1],
                ['name' => 'Meters', 'slug' => 'meters', 'short_code' => 'm', 'user_id' => 1],
                ['name' => 'Bundles', 'slug' => 'bundles', 'short_code' => 'bdl', 'user_id' => 1],
                ['name' => 'Bags', 'slug' => 'bags', 'short_code' => 'bag', 'user_id' => 1],
            ];
            foreach ($units as $unit) {
                Unit::create($unit);
            }
            $unitIds = Unit::pluck('id')->toArray();
        }

        // Hardware store products
        $products = [
            // Tools
            ['name' => 'Claw Hammer 16oz', 'buying_price' => 450, 'selling_price' => 650],
            ['name' => 'Ball Peen Hammer', 'buying_price' => 380, 'selling_price' => 550],
            ['name' => 'Rubber Mallet', 'buying_price' => 320, 'selling_price' => 480],
            ['name' => 'Sledge Hammer 4lb', 'buying_price' => 850, 'selling_price' => 1200],
            ['name' => 'Phillips Screwdriver Set', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Flathead Screwdriver Set', 'buying_price' => 420, 'selling_price' => 620],
            ['name' => 'Adjustable Wrench 12"', 'buying_price' => 520, 'selling_price' => 780],
            ['name' => 'Pipe Wrench 14"', 'buying_price' => 680, 'selling_price' => 950],
            ['name' => 'Socket Set 40pc', 'buying_price' => 1800, 'selling_price' => 2500],
            ['name' => 'Combination Wrench Set', 'buying_price' => 1200, 'selling_price' => 1750],
            ['name' => 'Needle Nose Pliers', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Slip Joint Pliers', 'buying_price' => 250, 'selling_price' => 380],
            ['name' => 'Locking Pliers', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Wire Cutters', 'buying_price' => 320, 'selling_price' => 480],
            ['name' => 'Utility Knife', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Hacksaw', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Hand Saw 20"', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Tape Measure 25ft', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Spirit Level 24"', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Chalk Line Reel', 'buying_price' => 220, 'selling_price' => 350],
            
            // Power Tools
            ['name' => 'Cordless Drill 18V', 'buying_price' => 3500, 'selling_price' => 4800],
            ['name' => 'Impact Driver', 'buying_price' => 4200, 'selling_price' => 5800],
            ['name' => 'Circular Saw 7"', 'buying_price' => 5500, 'selling_price' => 7500],
            ['name' => 'Jigsaw Electric', 'buying_price' => 3800, 'selling_price' => 5200],
            ['name' => 'Angle Grinder 4.5"', 'buying_price' => 2800, 'selling_price' => 3900],
            ['name' => 'Electric Sander', 'buying_price' => 2500, 'selling_price' => 3500],
            ['name' => 'Heat Gun', 'buying_price' => 1800, 'selling_price' => 2600],
            ['name' => 'Rotary Tool Kit', 'buying_price' => 2200, 'selling_price' => 3200],
            ['name' => 'Hammer Drill', 'buying_price' => 4800, 'selling_price' => 6500],
            ['name' => 'Reciprocating Saw', 'buying_price' => 4500, 'selling_price' => 6200],
            
            // Building Materials
            ['name' => 'Portland Cement 50kg', 'buying_price' => 550, 'selling_price' => 750],
            ['name' => 'Building Sand Ton', 'buying_price' => 2500, 'selling_price' => 3500],
            ['name' => 'Gravel 20mm Ton', 'buying_price' => 2800, 'selling_price' => 3800],
            ['name' => 'Building Blocks 6"', 'buying_price' => 35, 'selling_price' => 55],
            ['name' => 'Red Bricks', 'buying_price' => 12, 'selling_price' => 22],
            ['name' => 'Roofing Sheets 3m', 'buying_price' => 850, 'selling_price' => 1200],
            ['name' => 'Gypsum Board 4x8', 'buying_price' => 1200, 'selling_price' => 1650],
            ['name' => 'Plywood 18mm', 'buying_price' => 2800, 'selling_price' => 3800],
            ['name' => 'MDF Board 18mm', 'buying_price' => 2200, 'selling_price' => 3100],
            ['name' => 'Timber 2x4 8ft', 'buying_price' => 280, 'selling_price' => 420],
            
            // Plumbing
            ['name' => 'PVC Pipe 4" 6m', 'buying_price' => 450, 'selling_price' => 650],
            ['name' => 'PVC Pipe 2" 6m', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'PVC Elbow 4"', 'buying_price' => 85, 'selling_price' => 140],
            ['name' => 'PVC Tee 4"', 'buying_price' => 120, 'selling_price' => 180],
            ['name' => 'Gate Valve 1"', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Ball Valve 1"', 'buying_price' => 380, 'selling_price' => 580],
            ['name' => 'PTFE Tape Roll', 'buying_price' => 45, 'selling_price' => 80],
            ['name' => 'Pipe Sealant 100ml', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Water Tank 1000L', 'buying_price' => 8500, 'selling_price' => 11000],
            ['name' => 'Shower Head Chrome', 'buying_price' => 650, 'selling_price' => 950],
            
            // Electrical
            ['name' => 'Electrical Cable 2.5mm 100m', 'buying_price' => 4500, 'selling_price' => 6200],
            ['name' => 'Electrical Cable 1.5mm 100m', 'buying_price' => 3200, 'selling_price' => 4500],
            ['name' => 'Switch Socket Single', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Switch Socket Double', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Circuit Breaker 20A', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Distribution Board 8-Way', 'buying_price' => 1800, 'selling_price' => 2500],
            ['name' => 'LED Bulb 9W', 'buying_price' => 120, 'selling_price' => 200],
            ['name' => 'Fluorescent Tube 4ft', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Electrical Tape', 'buying_price' => 45, 'selling_price' => 80],
            ['name' => 'Junction Box', 'buying_price' => 85, 'selling_price' => 140],
            
            // Paint & Finishes
            ['name' => 'Emulsion Paint 20L White', 'buying_price' => 3500, 'selling_price' => 4800],
            ['name' => 'Gloss Paint 4L', 'buying_price' => 1200, 'selling_price' => 1750],
            ['name' => 'Wood Varnish 4L', 'buying_price' => 1400, 'selling_price' => 2000],
            ['name' => 'Primer 20L', 'buying_price' => 2800, 'selling_price' => 3900],
            ['name' => 'Paint Brush 4"', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Paint Roller Set', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Masking Tape 2"', 'buying_price' => 120, 'selling_price' => 200],
            ['name' => 'Sandpaper Pack 10', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Wood Filler 500g', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Paint Thinner 5L', 'buying_price' => 850, 'selling_price' => 1200],
            
            // Fasteners & Hardware
            ['name' => 'Nails 3" 5kg Box', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Nails 2" 5kg Box', 'buying_price' => 420, 'selling_price' => 620],
            ['name' => 'Wood Screws Assorted', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Concrete Screws 100pc', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Wall Plugs Assorted', 'buying_price' => 120, 'selling_price' => 200],
            ['name' => 'Bolts & Nuts Set', 'buying_price' => 450, 'selling_price' => 680],
            ['name' => 'Hinges 4" Pair', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Door Handle Set', 'buying_price' => 650, 'selling_price' => 950],
            ['name' => 'Padlock 50mm', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Chain Galvanized 10m', 'buying_price' => 850, 'selling_price' => 1200],
            
            // Safety Equipment
            ['name' => 'Safety Helmet', 'buying_price' => 350, 'selling_price' => 520],
            ['name' => 'Safety Goggles', 'buying_price' => 180, 'selling_price' => 280],
            ['name' => 'Work Gloves Pair', 'buying_price' => 120, 'selling_price' => 200],
            ['name' => 'Dust Mask 10pc', 'buying_price' => 150, 'selling_price' => 250],
            ['name' => 'Safety Boots Size 42', 'buying_price' => 1800, 'selling_price' => 2600],
            ['name' => 'Ear Plugs 10pc', 'buying_price' => 85, 'selling_price' => 140],
            ['name' => 'First Aid Kit', 'buying_price' => 650, 'selling_price' => 950],
            ['name' => 'Fire Extinguisher 2kg', 'buying_price' => 1500, 'selling_price' => 2200],
            ['name' => 'Reflective Vest', 'buying_price' => 280, 'selling_price' => 420],
            ['name' => 'Knee Pads Pair', 'buying_price' => 450, 'selling_price' => 680],
        ];

        $code = 1;
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'code' => str_pad($code, 5, '0', STR_PAD_LEFT),
                'quantity' => rand(10, 500),
                'quantity_alert' => 10,
                'buying_price' => $product['buying_price'],
                'selling_price' => $product['selling_price'],
                'tax' => 16,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'unit_id' => $unitIds[array_rand($unitIds)],
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => null,
            ]);
            $code++;
        }
    }
}

