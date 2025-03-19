@extends('layouts.main')

@section('container')
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">
            <div class="card-header text-center">{{ __('LIST OF BOOKS') }} </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Price</th>
                                <th scope="col">Release</th>
                                <th scope="col">Category</th>
                                <th scope="col">Order Amount</th>
                                <th scope="col">Cart</th>

                                @can('admin')
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/image/'.$book->image) }}" alt="{{ $book->title }}" style="height: 100px">
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->price }}</td>
                                <td>{{ $book->release }}</td>
                                <td>{{ $book->category->name }}</td>

                                <form action="{{ route('cartStore') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <td><input type="number" name="quantity" value="1"></td>
                                    <td><button type="submit" class="btn btn-secondary">Add to Cart</button></td>
                                </form>

                                @can('admin')
                                    <td>
                                        {{-- ke redirect ke update book by id --}}
                                        <a href="/update/{{ $book->id }}"><button type="button" class="btn btn-success">Update</button></a>
                                    </td>

                                    <td>
                                        {{-- {{route('deleteBook', ['id' => $book->id])}} == /update/{{ $book->id }} sama aja tbh--}}
                                        <form action="{{route('deleteBook', ['id' => $book->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger col-md" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection