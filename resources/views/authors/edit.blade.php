@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Author</h1>
        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Author Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Author</button>
        </form>
    </div>
@endsection
