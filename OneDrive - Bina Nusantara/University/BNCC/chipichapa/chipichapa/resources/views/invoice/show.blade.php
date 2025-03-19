@extends('layouts.main')

@section('title', 'Invoice')

@section('container')
    <h1 class="text-center">Faktur</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>Nomor Invoice:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $invoice->address }}</p>
    <p><strong>Kode Pos:</strong> {{ $invoice->postal_code }}</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rp{{ number_format(array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart)), 0, ',', '.') }}</h4>

        <form action="{{ route('invoice.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <input name="address" type="text" class="form-control" required minlength="10" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Kode Pos</label>
                <input name="postal_code" type="text" class="form-control" required pattern="\d{5}">
            </div>
            <button type="submit" class="btn btn-primary">Cetak Faktur</button>
        </form>

        <button onclick="window.print()" class="btn btn-secondary">Cetak Faktur</button>
    </div>
@endsection
