@extends('layouts.main')

@section('container')
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">

        {{-- $book->title, bakal ngeliat dari judul --}}
        <div class="card-header text-center">{{ __($book->title) }} </div>
            <div class="card-body">
                <form action="/update/{{ $book->id }}" method="POST" enctype="multipart/form-data">
                   
                @csrf {{-- biar data aman --}}
                @method('PATCH')

                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $book->title }}">
                </div>
                    
                <div class="mb-3">
                    <label for="" class="form-label">Author</label>
                    <input name="author" type="text" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $book->author }}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input name="price" type="text" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $book->price }}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Release</label>
                    <input name="release" type="date" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $book->release }}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input name="image" type="file" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $book->image }}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" id="">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{$category['name']}}
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