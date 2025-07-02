<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('author', 'genres')->paginate(5);

        if ($request->is('api/*')) {
            return response()->json($books);
        }

        return view('books.index', compact('books'));
    }

    public function create(Request $request)
    {
        $authors = Author::all();
        $genres = Genre::all();

        if ($request->is('api/*')) {
            return response()->json(compact('authors', 'genres'));
        }

        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ]);

        $book = Book::create($request->only('title', 'author_id'));
        $book->genres()->attach($request->genres);

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book created', 'book' => $book], 201);
        }

        return redirect()->route('books.index');
    }

    public function show(Request $request, $id)
    {
        $book = Book::with('author', 'genres', 'reviews')->findOrFail($id);

        if ($request->is('api/*')) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }

    public function edit(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $genres = Genre::all();

        if ($request->is('api/*')) {
            return response()->json(compact('book', 'authors', 'genres'));
        }

        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->only('title', 'author_id'));
        $book->genres()->sync($request->genres);

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book updated', 'book' => $book]);
        }

        return redirect()->route('books.index');
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Book deleted']);
        }

        return redirect()->route('books.index');
    }
}