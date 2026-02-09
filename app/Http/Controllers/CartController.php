<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            $items = $cartItems->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'image' => $item->product->image,
                    'quantity' => $item->quantity,
                ];
            });
        } else {
            $cart = Session::get('cart', []);
            $items = collect($cart)->map(function ($details, $id) {
                return [
                    'id' => $id,
                    'name' => $details['name'],
                    'price' => $details['price'],
                    'image' => $details['image'],
                    'quantity' => $details['quantity'],
                ];
            })->values();
        }

        return response()->json([
            'items' => $items,
            'total' => $items->sum(function($item) {
                return $item['price'] * $item['quantity'];
            }),
            'count' => $items->sum('quantity')
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $quantity = $request->quantity ?? 1;

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image
                ];
            }
            Session::put('cart', $cart);
        }

        return response()->json(['success' => 'Product added to cart successfully!']);
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
             if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->id)
                            ->first();
                if ($cartItem) {
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                }
             } else {
                $cart = Session::get('cart');
                if(isset($cart[$request->id])) {
                    $cart[$request->id]['quantity'] = $request->quantity;
                    Session::put('cart', $cart);
                }
             }
        }
        return response()->json(['success' => 'Cart updated successfully']);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->id)
                    ->delete();
            } else {
                $cart = Session::get('cart');
                if (isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    Session::put('cart', $cart);
                }
            }
        }
        return response()->json(['success' => 'Product removed successfully']);
    }
    
    public function clear() {
         if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
         } else {
            Session::forget('cart');
         }
         return response()->json(['success' => 'Cart cleared']);
    }
}
