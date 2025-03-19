<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function getCart()
    {
        $userId = Auth::user()->id;
        $items = Item::all();
        $carts = Cart::where('user_id', $userId)->get();

        return view('cart', [
            'title' => 'Cart',
            'items' => $items,
            'carts' => $carts
        ]);
    }

    public function cartStore(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        $quantity = $request->input('quantity');
    
        if ($quantity == 0) {
            Cart::where('user_id', Auth::id())->where('item_id', $request->item_id)->delete();
        } else {
            Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'item_id' => $request->item_id],
                ['quantity' => $quantity, 'subtotal' => $item->price * $quantity]
            );
        }
    
        return redirect(route('getCart'));
    }
    

    public function removeItem($id)
    {
        Cart::destroy($id);
        return redirect(route('getCart'));
    }

    public function add(Request $request, $id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
        $quantity = $request->input('quantity', 1);
    
        if ($item->quantity <= 0) {
            return redirect()->back()->with('error', 'Barang sudah habis.');
        }
    
        $cartItem = Cart::where('user_id', $user->id)
            ->where('item_id', $id)
            ->first();
    
        if ($cartItem) {
            $cartItem->quantity += $quantity; 
            $cartItem->subtotal = $cartItem->quantity * $item->price;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'item_id' => $id,
                'quantity' => $quantity, 
                'subtotal' => $item->price * $quantity
            ]);
        }
    
        return redirect(route('getCart'))->with('success', 'Item berhasil ditambahkan ke faktur.');
    }

    public function showInvoice()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        return view('invoice.show', compact('cart'));
    }
    

    public function submitInvoice(Request $request)
    {
        $cart = session()->get('cart', []);
        
        $invoiceNumber = 'INV-' . strtoupper(uniqid());

        $invoice = new Invoice([
            'invoice_number' => $invoiceNumber,
            'items' => json_encode($cart), 
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'total' => array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
        ]);
        
        $invoice->save();

        session()->forget('cart');

        return redirect()->route('invoice.show')->with('success', 'Invoice submitted successfully!');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('checkout', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->id] = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity
            ];
        }
    

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    
}
