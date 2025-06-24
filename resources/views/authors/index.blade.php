@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Authors</h1>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">Create New Author</a>
        <ul class="list-group mt-3">
            @foreach ($authors as $author)
                <li class="list-group-item">
                    {{ $author->name }}
                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info btn-sm float-right ml-2">View</a>
                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
