@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Review</h1>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <div class="mb-3">
            <label>Book</label>
            <select name="book_id" class="form-control" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
