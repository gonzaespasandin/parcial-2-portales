<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if(empty($cart)){
            return view('cart.index', [
                'cartItems' => [],
                'total' => 0,
            ]);
        }

        $productIds = array_keys($cart);

        $products = Products::whereIn('id', $productIds)->get();

        $cartItems = $products->map(function($product) use ($cart){
            return [
                'product' => $product,
                'quantity' => $cart[$product->id]['quantity'],
            ];
        });

        $total = $cartItems->sum(function($item){
            return $item['product']->price * $item['quantity'];
        });

        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function add(Request $request)
    {

        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ], [
            'product_id.required' => 'El producto es requerido',
            'product_id.integer' => 'El producto debe ser un número',
            'product_id.exists' => 'El producto no existe',
        ]);

        $user = Auth::user();
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');

        /** @var \App\Models\User $user */
        if($user->hasPurchasedProduct($productId)){
            return back()
                ->with('feedback.message', 'Ya has comprado este producto')
                ->with('feedback.type', 'danger');
        }

        if(isset($cart[$productId])){
            return back()
                ->with('feedback.message', 'Este producto ya está en tu carrito')
                ->with('feedback.type', 'danger');
        }

        $cart[$productId] = [
            'product_id' => $productId,
            'quantity' => 1,
        ];

        session(['cart' => $cart]);

        return back()
            ->with('feedback.message', 'Producto agregado al carrito')
            ->with('feedback.type', 'success');
    }

    public function remove(int $id)
    {
        $cart = session()->get('cart', []);

        if(!isset($cart[$id])){
            return back()
                ->with('feedback.message', 'El producto no está en tu carrito')
                ->with('feedback.type', 'danger');
        }

        unset($cart[$id]);

        session(['cart' => $cart]);

        return back()
            ->with('feedback.message', 'Producto eliminado del carrito')
            ->with('feedback.type', 'success');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()
            ->with('feedback.message', 'Carrito vaciado')
            ->with('feedback.type', 'success');
    }
}
