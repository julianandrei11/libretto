
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to the Dashboard</h1>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('authors.index') }}">Authors</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('books.index') }}">Books</a>
        </li>
       
        <li class="list-group-item">
            <a href="{{ route('genres.index') }}">Genres</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('reviews.index') }}">Reviews</a>
        </li>
    </ul>
</div>
@endsection