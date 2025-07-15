@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h2 class="mb-0">📚 Welcome to the Dashboard</h2>
                </div>
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('authors.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                            <i class="bi bi-person-lines-fill"></i> Authors
                        </a>
                        <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                            <i class="bi bi-book"></i> Books
                        </a>
                        <a href="{{ route('genres.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                            <i class="bi bi-tags"></i> Genres
                        </a>
                        <a href="{{ route('reviews.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                            <i class="bi bi-chat-left-text"></i> Reviews
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
