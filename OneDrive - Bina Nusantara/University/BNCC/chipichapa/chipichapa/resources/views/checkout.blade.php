<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout Page</h1>

    @if (empty($cartItems))
        <p>Your cart is empty.</p>
    @else
        <table border="1">
            <tr>
                <th>Kategori</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @php $total = 0; @endphp
            @foreach ($cartItems as $cartItem)
                @php
                    $subtotal = $cartItem->item->price * $cartItem->quantity;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $cartItem->item->category->name ?? '-' }}</td>
                    <td>{{ $cartItem->item->name }}</td>
                    <td>Rp. {{ number_format($cartItem->item->price, 0, ',', '.') }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <h3>Total Harga: Rp. {{ number_format($total, 0, ',', '.') }}</h3>
        
        <h2>Informasi Pengiriman</h2>
        <form action="{{ route('invoice.submit') }}" method="POST">
            @csrf
            <label for="address">Alamat Pengiriman:</label>
            <input type="text" name="address" id="address" required minlength="10" maxlength="100"><br>

            <label for="postal_code">Kode Pos:</label>
            <input type="text" name="postal_code" id="postal_code" required pattern="\d{5}"><br>

            <button type="submit">Proses Checkout</button>
        </form>

        <pre>{{ print_r($cartItems) }}</pre>

    @endif
</body>
</html>
