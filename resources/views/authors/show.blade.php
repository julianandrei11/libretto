@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $author->name }}</h1>
        <h3>Books by this author:</h3>
        <ul class="list-group">
            @foreach ($author->books as $book)
                <li class="list-group-item">{{ $book->title }}</li>
            @endforeach
        </ul>

        <a href="{{ route('authors.index') }}" class="btn btn-primary mt-3">Back to Authors List</a>
    </div>
@endsection
