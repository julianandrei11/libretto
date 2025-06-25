<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookGenreController extends Controller
{
    public function index()
    {
        $books = Book::with('genres')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::all();
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

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load('genres');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        $book->load('genres');
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

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->genres()->detach();
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }
}
