@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Genre: {{ $genre->name }}</h1>

    <h4>Books in this Genre:</h4>
    @if($genre->books->count())
        <ul class="list-group mt-2">
            @foreach($genre->books as $book)
                <li class="list-group-item">{{ $book->title }}</li>
            @endforeach
        </ul>
    @else
        <p class="mt-2">No books are assigned to this genre.</p>
    @endif

    <a href="{{ route('genres.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
