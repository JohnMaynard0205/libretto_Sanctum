<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of genres
     */
    public function index()
    {
        $genres = Genre::withCount('books')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $genres->items(),
            'pagination' => [
                'current_page' => $genres->currentPage(),
                'per_page' => $genres->perPage(),
                'total' => $genres->total(),
                'last_page' => $genres->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created genre
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        $genre = Genre::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully',
            'data' => $genre
        ], 201);
    }

    /**
     * Display the specified genre
     */
    public function show(Genre $genre)
    {
        $genre->load('books.author');
        
        return response()->json([
            'success' => true,
            'data' => $genre
        ]);
    }

    /**
     * Update the specified genre
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Genre updated successfully',
            'data' => $genre
        ]);
    }

    /**
     * Remove the specified genre
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully'
        ]);
    }
} 