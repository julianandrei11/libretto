<?php
namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     */
    public function index()
    {
        $genres = Genre::paginate(5); // Fetch 5 genres per page
        return view('genres.index', compact('genres'));
    }
    /**
     * Show the form for creating a new genre.
     */
    public function create()
    {
        return view('genres.create'); // Return the create view
    }

    /**
     * Store a newly created genre in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate the name field
        ]);

        Genre::create($request->all()); // Create a new genre
        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified genre.
     */
    public function show(Genre $genre)
    {
        return view('genres.show', compact('genre')); // Return the show view
    }

    /**
     * Show the form for editing the specified genre.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre')); // Return the edit view
    }

    /**
     * Update the specified genre in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate the name field
        ]);

        $genre->update($request->all()); // Update the genre
        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified genre from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete(); // Delete the genre
        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }
}