<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::paginate(5);

        if ($request->is('api/*')) {
            return response()->json($genres);
        }

        return view('genres.index', compact('genres'));
    }

    public function create(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json(['message' => 'Use POST /api/genres to create']);
        }

        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $genre = Genre::create($request->all());

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Genre created', 'genre' => $genre], 201);
        }

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    public function show(Request $request, Genre $genre)
    {
        if ($request->is('api/*')) {
            return response()->json($genre);
        }

        return view('genres.show', compact('genre'));
    }

    public function edit(Request $request, Genre $genre)
    {
        if ($request->is('api/*')) {
            return response()->json(['message' => 'Use PUT /api/genres/{id} to update']);
        }

        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $genre->update($request->all());

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Genre updated', 'genre' => $genre]);
        }

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy(Request $request, Genre $genre)
    {
        $genre->delete();

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Genre deleted']);
        }

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }
}