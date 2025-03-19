@extends('layouts.main')

@section('container')
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">
        <div class="card-header text-center">{{ __('INPUT NEW CATEGORY') }} </div>
            <div class="card-body">
                <form action="/create-Category" method="POST" enctype="multipart/form-data">
                   
                @csrf {{-- biar data aman --}}

                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>

                <button type="submit" class="btn btn-danger">Insert</button>
                    
                </form>
            </div>
        </div>
    </div>
@endsection