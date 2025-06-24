@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Create New Book</a>
        <ul class="list-group mt-3">
            @foreach ($books as $book)
                <li class="list-group-item">
                    {{ $book->title }} - {{ $book->author->name }}
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm float-right ml-2">View</a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
