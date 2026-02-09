<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Article;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_articles' => Article::count(),
            'total_events' => Event::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
