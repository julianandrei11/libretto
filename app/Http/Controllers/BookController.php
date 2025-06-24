<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        // Fetch all books with their associated authors and genres
        $books = Book::with('author', 'genres')->get();

        // Return the view with the books data
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        // Fetch all authors and genres to display in the creation form
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.create', compact('authors', 'genres'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ]);

        // Create the book with the provided data
        $book = Book::create($request->only('title', 'author_id'));

        // Attach genres to the book
        $book->genres()->attach($request->genres);

        // Redirect back to the books index page
        return redirect()->route('books.index');
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        // Retrieve the book with its author, genres, and reviews
        $book = Book::with('author', 'genres', 'reviews')->findOrFail($id);

        // Return the view with the book data
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit($id)
    {
        // Retrieve the book with its author and genres
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ]);

        // Find the book to update
        $book = Book::findOrFail($id);
        $book->update($request->only('title', 'author_id'));

        // Sync the genres with the book (this will update the genres attached to the book)
        $book->genres()->sync($request->genres);

        // Redirect back to the books index page
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy($id)
    {
        // Find the book to delete
        $book = Book::findOrFail($id);
        $book->delete();

        // Redirect back to the books index page
        return redirect()->route('books.index');
    }
}
