@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Author</h1>
        <form action="{{ route('authors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Author Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Create Author</button>
        </form>
    </div>
@endsection
