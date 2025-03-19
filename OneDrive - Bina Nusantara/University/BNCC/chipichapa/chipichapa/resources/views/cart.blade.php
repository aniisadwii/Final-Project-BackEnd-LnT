@extends('layouts.main')

@section('container')
<div class="container col-md-8" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('ORDERED ITEMS') }} </div>
        <div class="card-body">
            @if($carts->isEmpty())
                <p>Cart is empty</p>
                <p>Total: Rp.{{ number_format(0, 2, ',' , '.') }}</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order Amount</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Cart</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($carts as $cart)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/image/'.$cart->item->image) }}" alt="{{ $cart->item->title }}" style="height: 100px">
                            </td>
                            <td>{{ $cart->item->title }}</td>
                            <td>Rp.{{ number_format($cart->item->price, 2, ',' , '.') }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp.{{ number_format($cart->subtotal, 2, ',' , '.') }}</td>
                            <td>
                                <form action="/remove-cart-item/{{ $cart->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove from cart</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Total Harga -->
                        <tr>
                            <td colspan="6" class="text-end"><strong>Total Harga:</strong></td> 
                            <td>Rp.{{ number_format($carts->sum('subtotal'), 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="/checkout">
                    <button type="button" class="btn btn-success">Checkout</button>
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
