<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|string|size:5',
        ]);

        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        $invoiceNumber = 'INV-' . time(); // Generate invoice pakai timestamp

        $invoice = new Invoice();
        $invoice->number = $invoiceNumber;
        $invoice->address = $request->address;
        $invoice->postal_code = $request->postal_code;
        $invoice->total_price = array_sum(array_column($cartItems, 'subtotal'));
        $invoice->save();

        foreach ($cartItems as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);
        }
        session()->forget('cart'); 

        return view('invoice', compact('invoice'));
    }


    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }

    public function checkoutPage()
    {
        $cartItems = session()->get('cart', []);
        return view('checkout', compact('cartItems')); 
        
    }

}
