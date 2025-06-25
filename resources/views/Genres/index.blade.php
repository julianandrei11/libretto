@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Genres</h1>

    <a href="{{ route('genres.create') }}" class="btn btn-primary mb-3">Add New Genre</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Books Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($genres as $genre)
            <tr>
                <td>{{ $genre->name }}</td>
                <td>{{ $genre->books->count() }}</td>
                <td>
                    <a href="{{ route('genres.show', $genre) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this genre?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    <div class="mt-3">
        {{ $genres->links() }}
    </div>
@endsection
