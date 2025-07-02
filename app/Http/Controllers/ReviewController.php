<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with('book')->paginate(5);

        if ($request->is('api/*')) {
            return response()->json($reviews);
        }

        return view('reviews.index', compact('reviews'));
    }

    public function create(Request $request)
    {
        $books = Book::all();

        if ($request->is('api/*')) {
            return response()->json(compact('books'));
        }

        return view('reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        $review = Review::create($request->only('book_id', 'content', 'rating'));

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Review created', 'review' => $review], 201);
        }

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    public function show(Request $request, Review $review)
    {
        $review->load('book');

        if ($request->is('api/*')) {
            return response()->json($review);
        }

        return view('reviews.show', compact('review'));
    }

    public function edit(Request $request, Review $review)
    {
        $books = Book::all();

        if ($request->is('api/*')) {
            return response()->json(compact('review', 'books'));
        }

        return view('reviews.edit', compact('review', 'books'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        $review->update($request->only('book_id', 'content', 'rating'));

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Review updated', 'review' => $review]);
        }

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Request $request, Review $review)
    {
        $review->delete();

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Review deleted']);
        }

        return redirect()->route('reviews.index')->with('success', 'Review deleted.');
    }
}
