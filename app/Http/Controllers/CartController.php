<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[$id] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'price' => $product->final_price,
                    'total' => $product->final_price * $details['quantity']
                ];
                $subtotal += $cartItems[$id]['total'];
            }
        }
        
        $shipping = $subtotal > 5000 ? 0 : 150;
        $tax = $subtotal * 0.18; // 18% GST
        $total = $subtotal + $shipping + $tax;
        
        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }
    
    /**
     * Add product to cart
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->stock < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Product is out of stock!'
            ]);
        }
        
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->final_price,
                'image' => $product->image
            ];
        }
        
        Session::put('cart', $cart);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => count($cart)
            ]);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
    
    /**
     * Update cart quantity
     */
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $quantity = max(1, intval($request->quantity));
            $product = Product::find($id);
            
            if ($product && $quantity <= $product->stock) {
                $cart[$id]['quantity'] = $quantity;
                Session::put('cart', $cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully!',
                    'item_total' => $product->final_price * $quantity
                ]);
            }
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Unable to update cart'
        ]);
    }
    
    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => count($cart)
        ]);
    }
    
    /**
     * Get cart count
     */
    public function count()
    {
        $cart = Session::get('cart', []);
        return response()->json(['count' => count($cart)]);
    }
    
    /**
     * Clear entire cart
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}