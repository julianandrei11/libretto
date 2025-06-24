<?php

// In app/Http/Controllers/BookController.php
// app/Http/Controllers/AuthorController.php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Display a listing of authors
    public function index()
    {
        $authors = Author::all();  // Get all authors
        return view('authors.index', compact('authors'));
    }

    // Show the form for creating a new author
    public function create()
    {
        return view('authors.create');
    }

    // Store a newly created author in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create($request->all());  // Store the new author

        return redirect()->route('authors.index');
    }

    // Display the specified author
    public function show($id)
    {
        $author = Author::findOrFail($id);  // Find the author
        return view('authors.show', compact('author'));
    }

    // Show the form for editing the specified author
    public function edit($id)
    {
        $author = Author::findOrFail($id);  // Find the author to edit
        return view('authors.edit', compact('author'));
    }

    // Update the specified author in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->all());  // Update the author

        return redirect()->route('authors.index');
    }

    // Remove the specified author from storage
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();  // Delete the author

        return redirect()->route('authors.index');
    }
}
