<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookGenreController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('genres')->get();

        if ($request->is('api/*')) {
            return response()->json($books);
        }

        return view('books.index', compact('books'));
    }

    public function create(Request $request)
    {
        $genres = Genre::all();

        if ($request->is('api/*')) {
            return response()->json(compact('genres'));
        }

        return view('books.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'genre_ids' => 'array|exists:genres,id'
        ]);

        $book = Book::create($request->only('title', 'author_id'));
        $book->genres()->attach($request->genre_ids);

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book created', 'book' => $book], 201);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Request $request, Book $book)
    {
        $book->load('genres');

        if ($request->is('api/*')) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }

    public function edit(Request $request, Book $book)
    {
        $genres = Genre::all();
        $book->load('genres');

        if ($request->is('api/*')) {
            return response()->json(compact('book', 'genres'));
        }

        return view('books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'genre_ids' => 'array|exists:genres,id'
        ]);

        $book->update($request->only('title', 'author_id'));
        $book->genres()->sync($request->genre_ids);

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book updated', 'book' => $book]);
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Request $request, Book $book)
    {
        $book->genres()->detach();
        $book->delete();

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book deleted']);
        }

        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }
}