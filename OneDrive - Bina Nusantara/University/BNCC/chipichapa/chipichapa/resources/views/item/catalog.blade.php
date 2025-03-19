@extends('layouts.main')

@section('title', 'Item Catalog')

@section('container')
    <div class="container">
        <h1 class="text-center mb-4">Item Catalog</h1>

        <div class="row g-4">
            @foreach ($items as $item)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card item-card shadow-sm">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top item-img" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" class="card-img-top item-img" alt="No Image Available">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->name }}</h5>
                            <p class="card-text"><strong>Category:</strong> {{ $item->category->name }}</p>
                            <p class="card-text"><strong>Price:</strong> Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="card-text">
                                <strong>Stock:</strong> 
                                <span class="{{ $item->quantity > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $item->quantity > 0 ? $item->quantity : 'Barang sudah habis' }}
                                </span>
                            </p>

                            @if ($item->quantity > 0)
                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="quantity_{{ $item->id }}">Jumlah:</label>
                                        <input type="number" name="quantity" id="quantity_{{ $item->id }}" 
                                            class="form-control form-control-sm" min="1" max="{{ $item->quantity }}" 
                                            value="1" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Tambah ke Faktur</button>
                                </form>
                            @else
                                <button class="btn btn-danger w-100" disabled>Barang Habis</button>
                            @endif

                            {{-- Tombol CRUD hanya untuk admin --}}
                            @if (Auth::user() && Auth::user()->role === 'admin')
                                <div class="mt-2 d-flex justify-content-between">
                                    <a href="{{ route('updateItemPage', $item->id) }}" class="btn btn-warning w-45">Edit</a>

                                    <form action="{{ route('deleteItem', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-45" 
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
