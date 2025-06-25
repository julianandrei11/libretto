@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Author ID</label>
            <input type="number" name="author_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Genres</label>
            <select name="genre_ids[]" class="form-control" multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
