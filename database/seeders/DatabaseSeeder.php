<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Mobile Phones',
                'slug' => 'mobile-phones',
                'description' => 'Latest smartphones and mobile devices',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Mobile accessories and gadgets',
            ],
            [
                'name' => 'Cases & Covers',
                'slug' => 'cases-covers',
                'description' => 'Protective cases and covers',
            ],
            [
                'name' => 'Chargers & Cables',
                'slug' => 'chargers-cables',
                'description' => 'Charging solutions',
            ],
            [
                'name' => 'Headphones',
                'slug' => 'headphones',
                'description' => 'Audio accessories',
            ],
            [
                'name' => 'Screen Protectors',
                'slug' => 'screen-protectors',
                'description' => 'Screen protection solutions',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products
        $products = [
            // Headphones
            [
                'category_id' => 5,
                'name' => 'Premium Wireless Earbuds',
                'slug' => 'premium-wireless-earbuds',
                'description' => 'High-quality wireless earbuds with active noise cancellation, premium sound quality, and long battery life. Perfect for music lovers and professionals.',
                'price' => 129.99,
                'discount_price' => 99.99,
                'brand' => 'TechPro',
                'stock' => 25,
                'image' => 'products/earbuds.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Sports Bluetooth Headphones',
                'slug' => 'sports-bluetooth-headphones',
                'description' => 'Sweat-resistant wireless headphones designed for active lifestyles. Secure fit and powerful bass.',
                'price' => 79.99,
                'brand' => 'FitSound',
                'stock' => 30,
                'image' => 'products/headphones.jpg',
                'is_featured' => true,
            ],
            // Cases
            [
                'category_id' => 3,
                'name' => 'Rugged Armor Phone Case',
                'slug' => 'rugged-armor-phone-case',
                'description' => 'Military-grade protection with shock-absorbing technology. Protects your phone from drops and impacts.',
                'price' => 39.99,
                'discount_price' => 29.99,
                'brand' => 'ArmorShield',
                'stock' => 50,
                'image' => 'products/case.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Slim Leather Wallet Case',
                'slug' => 'slim-leather-wallet-case',
                'description' => 'Premium leather case with card slots and stand feature. Elegant design with full protection.',
                'price' => 49.99,
                'brand' => 'LuxCase',
                'stock' => 35,
                'image' => 'products/leather-case.jpg',
                'is_featured' => true,
            ],
            // Chargers
            [
                'category_id' => 4,
                'name' => 'Fast Wireless Charger',
                'slug' => 'fast-wireless-charger',
                'description' => '30W fast wireless charging pad with LED indicator. Compatible with all Qi-enabled devices.',
                'price' => 49.99,
                'discount_price' => 39.99,
                'brand' => 'QuickCharge',
                'stock' => 40,
                'image' => 'products/wireless-charger.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'USB-C Fast Charging Cable',
                'slug' => 'usb-c-fast-charging-cable',
                'description' => 'Durable braided cable with fast charging support. 6ft length for convenient use.',
                'price' => 19.99,
                'brand' => 'QuickCharge',
                'stock' => 100,
                'image' => 'products/cable.jpg',
                'is_featured' => true,
            ],
            // Screen Protectors
            [
                'category_id' => 6,
                'name' => 'Tempered Glass Screen Protector',
                'slug' => 'tempered-glass-screen-protector',
                'description' => '9H hardness tempered glass with oleophobic coating. Easy installation with bubble-free adhesive.',
                'price' => 24.99,
                'discount_price' => 19.99,
                'brand' => 'ShieldPro',
                'stock' => 75,
                'image' => 'products/screen-protector.jpg',
                'is_featured' => false,
            ],
            // More Accessories
            [
                'category_id' => 2,
                'name' => 'Phone Ring Holder Stand',
                'slug' => 'phone-ring-holder-stand',
                'description' => '360-degree rotation ring holder with stand function. Secure grip and convenient viewing.',
                'price' => 14.99,
                'brand' => 'GripMaster',
                'stock' => 60,
                'image' => 'products/ring-holder.jpg',
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Car Phone Mount',
                'slug' => 'car-phone-mount',
                'description' => 'Magnetic car mount with 360-degree rotation. Strong hold and easy one-hand operation.',
                'price' => 29.99,
                'brand' => 'AutoGrip',
                'stock' => 45,
                'image' => 'products/car-mount.jpg',
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Power Bank 20000mAh',
                'slug' => 'power-bank-20000mah',
                'description' => 'High-capacity portable charger with dual USB ports and fast charging. LED display shows battery level.',
                'price' => 59.99,
                'discount_price' => 49.99,
                'brand' => 'PowerMax',
                'stock' => 35,
                'image' => 'products/power-bank.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create Services
        $services = [
            [
                'name' => 'Screen Replacement',
                'slug' => 'screen-replacement',
                'description' => 'Professional screen replacement service for all mobile brands. We use high-quality OEM or original screens with warranty. Our expert technicians ensure perfect installation.',
                'price' => 89.99,
                'icon' => 'fas fa-mobile-screen',
                'duration' => 60,
            ],
            [
                'name' => 'Battery Replacement',
                'slug' => 'battery-replacement',
                'description' => 'Replace your old, worn-out battery with a new high-capacity one. Restore your phone\'s battery life to like-new condition. Quick service available.',
                'price' => 49.99,
                'icon' => 'fas fa-battery-full',
                'duration' => 45,
            ],
            [
                'name' => 'Water Damage Repair',
                'slug' => 'water-damage-repair',
                'description' => 'Comprehensive water damage repair service. We clean, dry, and restore your device using specialized equipment. High success rate for recent damage.',
                'price' => 79.99,
                'icon' => 'fas fa-droplet',
                'duration' => 120,
            ],
            [
                'name' => 'Charging Port Repair',
                'slug' => 'charging-port-repair',
                'description' => 'Fix loose or damaged charging ports. Restore proper charging functionality with genuine replacement parts.',
                'price' => 59.99,
                'icon' => 'fas fa-plug',
                'duration' => 60,
            ],
            [
                'name' => 'Camera Repair',
                'slug' => 'camera-repair',
                'description' => 'Repair or replace faulty front or rear cameras. Fix blurry photos, focus issues, and cracked camera glass.',
                'price' => 69.99,
                'icon' => 'fas fa-camera',
                'duration' => 90,
            ],
            [
                'name' => 'Software Troubleshooting',
                'slug' => 'software-troubleshooting',
                'description' => 'Fix software issues, remove malware, speed up your device, and optimize performance. Data backup included.',
                'price' => 39.99,
                'icon' => 'fas fa-code',
                'duration' => 60,
            ],
            [
                'name' => 'Speaker Repair',
                'slug' => 'speaker-repair',
                'description' => 'Restore sound quality by repairing or replacing damaged speakers. Fix muffled audio and no sound issues.',
                'price' => 54.99,
                'icon' => 'fas fa-volume-high',
                'duration' => 75,
            ],
            [
                'name' => 'Back Glass Replacement',
                'slug' => 'back-glass-replacement',
                'description' => 'Replace cracked or shattered back glass. Restore your phone\'s appearance with precision repair.',
                'price' => 99.99,
                'icon' => 'fas fa-tablet-screen-button',
                'duration' => 90,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create Testimonials
        $testimonials = [
            [
                'customer_name' => 'Sujal Lamichhane',
                'review' => 'Excellent service! My iPhone screen was replaced in just 30 minutes. The quality is amazing and the price was very reasonable. Highly recommend Smart Techno Hub!',
                'rating' => 5,
                'service_type' => 'Screen Replacement',
            ],
            [
                'customer_name' => 'Santosh Lamichhane',
                'review' => 'They saved my phone after I dropped it in water. The technicians were professional and kept me updated throughout the process. Thank you!',
                'rating' => 5,
                'service_type' => 'Water Damage Repair',
            ],
            [
                'customer_name' => 'Ashu Roka',
                'review' => 'Fast and reliable battery replacement service. My phone lasts all day now. Great customer service and fair pricing.',
                'rating' => 5,
                'service_type' => 'Battery Replacement',
            ],
            [
                'customer_name' => 'Aayush Lama',
                'review' => 'Very satisfied with the screen protector and phone case I bought. High quality products at great prices. Will definitely shop here again!',
                'rating' => 5,
                'service_type' => 'Product Purchase',
            ],
            [
                'customer_name' => 'Nawaraj Lamsal',
                'review' => 'Professional team and quick turnaround time. My charging port issue was fixed in less than an hour. Excellent work!',
                'rating' => 5,
                'service_type' => 'Charging Port Repair',
            ],
            [
                'customer_name' => 'Rajesh Hamal',
                'review' => 'The camera repair service was outstanding. My photos look crystal clear again. Thank you for the quality service!',
                'rating' => 5,
                'service_type' => 'Camera Repair',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}