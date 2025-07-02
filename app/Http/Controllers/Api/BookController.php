<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of books
     */
    public function index()
    {
        $books = Book::with(['author', 'genres', 'reviews'])->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $books->items(),
            'pagination' => [
                'current_page' => $books->currentPage(),
                'per_page' => $books->perPage(),
                'total' => $books->total(),
                'last_page' => $books->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create($request->only(['title', 'author_id']));
        
        if ($request->has('genres')) {
            $book->genres()->attach($request->genres);
        }

        $book->load(['author', 'genres']);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified book
     */
    public function show(Book $book)
    {
        $book->load(['author', 'genres', 'reviews']);
        
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update($request->only(['title', 'author_id']));
        
        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        } else {
            $book->genres()->detach();
        }

        $book->load(['author', 'genres']);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified book
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ]);
    }

    /**
     * Get all authors (for dropdowns)
     */
    public function authors()
    {
        $authors = Author::select('id', 'name')->get();
        
        return response()->json([
            'success' => true,
            'data' => $authors
        ]);
    }

    /**
     * Get all genres (for checkboxes)
     */
    public function genres()
    {
        $genres = Genre::select('id', 'name')->get();
        
        return response()->json([
            'success' => true,
            'data' => $genres
        ]);
    }
} 