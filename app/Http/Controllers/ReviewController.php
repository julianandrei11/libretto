<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->paginate(5); // Adjust 5 to however many per page you want
        return view('Reviews.index', compact('reviews'));
    }
    

    public function create()
    {
        $books = Book::all();
        return view('Reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        Review::create($request->only('book_id', 'content', 'rating'));

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    public function show(Review $review)
    {
        $review->load('book');
        return view('Reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $books = Book::all();
        return view('Reviews.edit', compact('review', 'books'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        $review->update($request->only('book_id', 'content', 'rating'));

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted.');
    }
}
