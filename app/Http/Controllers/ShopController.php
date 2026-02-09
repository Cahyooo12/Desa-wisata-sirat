<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        $products = $query->get();
        $categories = [
            ['id' => 'All', 'label' => 'Semua', 'icon' => 'storefront'],
            ['id' => 'Drink', 'label' => 'Minuman', 'icon' => 'local_cafe'],
            ['id' => 'Care', 'label' => 'Perawatan', 'icon' => 'spa'],
            ['id' => 'Seed', 'label' => 'Bibit', 'icon' => 'grass'],
        ];

        $currentCategory = $request->category ?? 'All';

        return view('shop.index', compact('products', 'categories', 'currentCategory'));
    }
}
