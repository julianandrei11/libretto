@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <p><strong>Author ID:</strong> {{ $book->author_id }}</p>
    <p><strong>Genres:</strong>
        @foreach ($book->genres as $genre)
            <span class="badge bg-secondary">{{ $genre->name }}</span>
        @endforeach
    </p>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
