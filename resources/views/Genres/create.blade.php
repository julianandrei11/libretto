@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Genre</h1>

    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Genre Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Create</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
