<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $user = Auth::user();
        $items = [];
        $total = 0;

        if ($user) {
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
            foreach ($cartItems as $cartItem) {
                $items[] = [
                    'product_id' => $cartItem->product_id,
                    'name' => $cartItem->product->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ];
                $total += $cartItem->product->price * $cartItem->quantity;
            }
        } else {
            $cart = Session::get('cart', []);
            foreach ($cart as $id => $details) {
                $items[] = [
                    'product_id' => $id,
                    'name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ];
                $total += $details['price'] * $details['quantity'];
            }
        }

        if (empty($items)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        // Create Order
        $order = Order::create([
            'user_id' => $user ? $user->id : null, // nullable in DB? need to check
            'total_price' => $total,
            'status' => 'pending',
            'payment_proof' => null
        ]);

        // Create Order Items
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear Cart
        if ($user) {
            Cart::where('user_id', $user->id)->delete();
        } else {
            Session::forget('cart');
        }

        // Generate WhatsApp Message
        $waNumber = '6285229312990'; // Configurable?
        $message = "Halo Desa Wisata Bunga Telang, saya ingin memesan:\n\n" .
                   "Data Pemesan:\n" .
                   "Nama: " . $request->name . "\n" .
                   "Alamat: " . $request->address . "\n" .
                   "Catatan: " . ($request->note ?? '-') . "\n" .
                   "Order ID: #" . $order->id . "\n\n" .
                   "Pesanan:\n";

        foreach ($items as $item) {
            $message .= "- " . $item['name'] . " (" . $item['quantity'] . "x) - Rp" . number_format($item['price'] * $item['quantity'], 0, ',', '.') . "\n";
        }

        $message .= "\nTotal: Rp" . number_format($total, 0, ',', '.') . "\n\n" .
                    "Mohon informasi pembayarannya. Terima kasih!";

        $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($message);

        return response()->json(['redirect_url' => $waUrl]);
    }
}
