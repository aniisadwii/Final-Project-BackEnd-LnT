<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
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
        $subtotal = $item->price * $quantity;

        if ($quantity == 0) {
            Cart::where('user_id', $request->user_id)
                ->where('item_id', $request->item_id)
                ->delete();
        } else {
            Cart::create([
                'user_id' => $request->user_id,
                'item_id' => $request->item_id,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ]);
        }

        return redirect(route('view'));
    }

    public function removeItem($id)
    {
        Cart::destroy($id);
        return redirect(route('getCart'));
    }

    public function add($id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
    
        if ($item->quantity <= 0) {
            return redirect()->back()->with('error', 'Barang sudah habis.');
        }
    
        $cartItem = Cart::where('user_id', $user->id)
            ->where('item_id', $id)
            ->first();
    
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->subtotal = $cartItem->quantity * $item->price;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'item_id' => $id,
                'quantity' => 1,
                'subtotal' => $item->price
            ]);
        }
    
        return redirect(route('getCart'))->with('success', 'Item berhasil ditambahkan ke faktur.');
    }
    
}
