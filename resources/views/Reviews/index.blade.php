
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reviews</h1>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">Add Review</a>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Book</th>
                <th>Content</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->book->title }}</td>
                <td>{{ $review->content }}</td>
                <td>{{ $review->rating }}</td>
                <td>
                    <a href="{{ route('reviews.show', $review) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this review?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if ($reviews->isEmpty())
        <p class="mt-3">No reviews found.</p>
    @endif
</div>
<div class="mt-3">
    {{ $reviews->links() }} 
</div>
@endsection