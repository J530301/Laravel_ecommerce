<?php

namespace Database\Seeders; // Add this line

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'MacBook Pro 16-inch',
            'price' => 2499,
            'specs' => '6.7-inch OLED display, A17 Bionic Chip, 48MP Main Camera, 256GB Storage, iOS 17',
            'image' => 'samsung.jpg',
            'stock' => 10,
            'category' => 'Phones'
        ]);
        
        Product::create([
            'name' => 'Lenovo ThinkPad X1 Carbon',
            'price' => 1899,
            'specs' => '6.7-inch OLED display, A17 Bionic Chip, 48MP Main Camera, 256GB Storage, iOS 17',
            'image' => 'googlepixel.jpg',
            'stock' => 10,
            'category' => 'Phones'
        ]);

        Product::create([
            'name' => 'ASUS ROG Zephyrus G14',
            'price' => 1799,
            'specs' => '6.7-inch OLED display, A17 Bionic Chip, 48MP Main Camera, 256GB Storage, iOS 17',
            'image' => 'googlepixel.jpg',
            'stock' => 10,
            'category' => 'Phones'
        ]);
    }
}
