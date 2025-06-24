@extends('layouts.app')

@section('content')
    <h1>Authors</h1>
    <a href="{{ route('authors.create') }}">Create New Author</a>
    <ul>
        @foreach($authors as $author)
            <li>{{ $author->name }} - <a href="{{ route('authors.edit', $author->id) }}">Edit</a></li>
        @endforeach
    </ul>
@endsection
