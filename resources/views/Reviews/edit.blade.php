@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Review</h1>
    <form method="POST" action="{{ route('reviews.update', $review) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Book</label>
            <select name="book_id" class="form-control" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $review->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" required>{{ $review->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
