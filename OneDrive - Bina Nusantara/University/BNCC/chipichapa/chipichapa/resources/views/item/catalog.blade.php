

@extends('layouts.main')

@section('title', 'Item Catalog')

@section('container')
    <h1 class="text-center">Item Catalog</h1>
    
    <div class="row">
        @foreach ($items as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="No Image Available">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text"><strong>Category:</strong> {{ $item->category->name }}</p>
                        <p class="card-text"><strong>Price:</strong> Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $item->quantity > 0 ? $item->quantity : 'Barang sudah habis' }}</p>

                        @if ($item->quantity > 0)
                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Tambah ke Faktur</button>
                            </form>
                        @else
                            <button class="btn btn-danger" disabled>Barang Habis</button>
                        @endif

                        {{-- Tombol CRUD hanya untuk admin --}}
                        @if (Auth::user() && Auth::user()->role === 'admin')
                            <a href="{{ route('updateItemPage', $item->id) }}" class="btn btn-warning">Edit</a>
                

                            <form action="{{ route('deleteItem', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
