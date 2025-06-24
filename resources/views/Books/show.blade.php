@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author->name }}</p>
        <p><strong>Genres:</strong> 
            @foreach ($book->genres as $genre)
                {{ $genre->name }} 
            @endforeach
        </p>
        <h3>Reviews:</h3>
        <ul>
            @foreach ($book->reviews as $review)
                <li>{{ $review->content }} (Rating: {{ $review->rating }})</li>
            @endforeach
        </ul>
        <a href="{{ route('books.index') }}" class="btn btn-primary">Back to Books</a>
    </div>
@endsection
