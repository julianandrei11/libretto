@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Genre</h1>

    <form action="{{ route('genres.update', $genre) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Genre Name</label>
            <input type="text" name="name" value="{{ $genre->name }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
