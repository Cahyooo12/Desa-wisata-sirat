<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Teh Telang Kemasan',
                'price' => 10000,
                'description' => 'Teh celup bunga telang praktis siap seduh.',
                'category' => 'Drink',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc458681b3?auto=format&fit=crop&q=80&w=400',
                'ingredients' => '100% Bunga Telang (Clitoria ternatea) pilihan yang dikeringkan.',
                'usage' => 'Seduh 1 kantong teh dalam 200ml air panas (80-90°C) selama 3-5 menit.',
                'size' => 'Isi 10 kantong teh celup (2g/kantong)',
                'stock' => 100
            ],
            [
                'name' => 'Teh Telang Kering',
                'price' => 30000,
                'description' => 'Bunga telang utuh yang dikeringkan secara alami.',
                'category' => 'Drink',
                'image' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?auto=format&fit=crop&q=80&w=400',
                'ingredients' => 'Kelopak bunga telang segar pilihan tanpa tambahan kimia.',
                'usage' => 'Masukkan 5-7 kuntum bunga kering ke dalam gelas, seduh dengan air panas.',
                'size' => 'Kemasan Zipper Bag 50 gram',
                'stock' => 50
            ],
            [
                'name' => 'Sirup Bunga Telang',
                'price' => 20000,
                'description' => 'Sirup manis konsentrat dengan warna biru cantik.',
                'category' => 'Drink',
                'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&q=80&w=400',
                'ingredients' => 'Ekstrak bunga telang, gula pasir murni, air, dan perisa alami.',
                'usage' => 'Campurkan 2-3 sendok makan sirup ke dalam 200ml air dingin atau soda.',
                'size' => 'Botol Kaca 250 ml',
                'stock' => 30
            ],
            [
                'name' => 'Sabun Batang Telang',
                'price' => 10000,
                'description' => 'Sabun alami untuk melembabkan kulit.',
                'category' => 'Care',
                'image' => 'https://images.unsplash.com/photo-1600857062241-98e5dba7f214?auto=format&fit=crop&q=80&w=400',
                'ingredients' => 'Minyak kelapa, ekstrak bunga telang, gliserin, dan minyak zaitun.',
                'usage' => 'Gunakan saat mandi, busakan pada seluruh tubuh, lalu bilas hingga bersih.',
                'size' => 'Batang 80 gram',
                'stock' => 200
            ],
            [
                'name' => 'Sabun Cair Telang',
                'price' => 30000,
                'description' => 'Sabun cair lembut dengan manfaat anti-inflamasi.',
                'category' => 'Care',
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71f1e3c7e0?auto=format&fit=crop&q=80&w=400',
                'ingredients' => 'Aqua, ekstrak telang, potassium cocoate, aloe vera, dan vitamin E.',
                'usage' => 'Tuangkan pada telapak tangan atau puff mandi, aplikasikan pada kulit basah.',
                'size' => 'Botol Pump 250 ml',
                'stock' => 45
            ],
            [
                'name' => 'Bibit Bunga Telang',
                'price' => 30000,
                'description' => 'Bibit tanaman telang berkualitas siap tanam.',
                'category' => 'Seed',
                'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&q=80&w=400',
                'ingredients' => 'Biji bunga telang (Clitoria ternatea) varietas ungu tumpuk.',
                'usage' => 'Rendam biji dalam air hangat semalam, tanam pada media tanah subur.',
                'size' => 'Paket 20 butir biji unggul',
                'stock' => 1000
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
