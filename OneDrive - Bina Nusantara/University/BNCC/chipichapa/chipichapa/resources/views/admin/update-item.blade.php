@extends('layouts.main')

@section('container')
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">
            <div class="card-header text-center">{{ __($item->name) }}</div>
            <div class="card-body">
                <form action="{{ route('items.update', $item->id) }}" method="POST">
                    @csrf {{-- Token CSRF untuk keamanan --}}
                    @method('PUT')

                    {{-- Nama Item --}}
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" value="{{ $item->name }}">
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input name="price" type="number" class="form-control" value="{{ $item->price }}">
                    </div>

                    {{-- Stok --}}
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input name="quantity" type="number" class="form-control" value="{{ $item->quantity }}">
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input name="image" type="file" class="form-control">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
