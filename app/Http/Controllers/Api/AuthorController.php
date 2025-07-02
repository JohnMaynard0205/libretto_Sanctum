<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors
     */
    public function index()
    {
        $authors = Author::with('books')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $authors->items(),
            'pagination' => [
                'current_page' => $authors->currentPage(),
                'per_page' => $authors->perPage(),
                'total' => $authors->total(),
                'last_page' => $authors->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created author
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
        ]);

        $author = Author::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    /**
     * Display the specified author
     */
    public function show(Author $author)
    {
        $author->load('books.genres', 'books.reviews');
        
        return response()->json([
            'success' => true,
            'data' => $author
        ]);
    }

    /**
     * Update the specified author
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,' . $author->id,
        ]);

        $author->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully',
            'data' => $author
        ]);
    }

    /**
     * Remove the specified author
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Author deleted successfully'
        ]);
    }
} 