<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::latest()->paginate(5);

        if ($request->is('api/*')) {
            return response()->json($authors);
        }

        return view('authors.index', compact('authors'));
    }

    public function create(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json(['message' => 'Use POST /api/authors to create']);
        }

        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($request->all());

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Author created successfully',
                'author' => $author
            ], 201);
        }

        return redirect()->route('authors.index');
    }

    public function show(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        if ($request->is('api/*')) {
            return response()->json($author);
        }

        return view('authors.show', compact('author'));
    }

    public function edit(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        if ($request->is('api/*')) {
            return response()->json(['message' => 'Use PUT /api/authors/{id} to update']);
        }

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->all());

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Author updated successfully',
                'author' => $author
            ]);
        }

        return redirect()->route('authors.index');
    }

    public function destroy(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Author deleted successfully'
            ]);
        }

        return redirect()->route('authors.index');
    }
}
