@extends('layouts.main')

@section('container')
<div class="container col-md-6" style="padding-top: 20px">
    <div class="card shadow">
        <div class="card-header text-center">{{ __('INPUT NEW ITEM') }}</div>
        <div class="card-body">
            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang</label>
                    <input name="name" type="text" class="form-control" placeholder="Masukkan nama barang" value="{{ old('name') }}" required minlength="5" maxlength="80">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga Barang</label>
                    <input name="price" type="number" class="form-control" placeholder="Masukkan harga barang" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah Barang</label>
                    <input name="quantity" type="number" class="form-control" placeholder="Masukkan jumlah barang" value="{{ old('quantity') }}" required min="1">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Foto Barang</label>
                    <input name="image" type="file" class="form-control" accept="image/*" required>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori Barang</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah Barang</button>
            </form>
        </div>
    </div>
</div>
@endsection
