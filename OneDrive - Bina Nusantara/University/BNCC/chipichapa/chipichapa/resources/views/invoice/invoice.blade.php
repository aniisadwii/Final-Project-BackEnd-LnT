<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice</h1>
    <p>Nomor Invoice: {{ $invoice->number }}</p>
    <p>Alamat: {{ $invoice->address }}</p>
    <p>Kode Pos: {{ $invoice->postal_code }}</p>

    <table border="1">
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <h3>Total Harga: Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</h3>

    <button onclick="window.print()">Cetak Faktur</button>
</body>
</html>
