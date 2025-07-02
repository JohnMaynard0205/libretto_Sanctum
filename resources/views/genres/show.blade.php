@extends('layouts.app')

@section('title', $genre->name . ' - Genres')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tags"></i> Genre Details
                </h5>
            </div>
            <div class="card-body">
                <h4>{{ $genre->name }}</h4>
                <hr>
                <p><strong>ID:</strong> {{ $genre->id }}</p>
                <p><strong>Books Count:</strong> {{ $genre->books->count() }}</p>
                <p><strong>Created:</strong> {{ $genre->created_at->format('M d, Y H:i') }}</p>
                <p><strong>Updated:</strong> {{ $genre->updated_at->format('M d, Y H:i') }}</p>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this genre?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-book"></i> Books in "{{ $genre->name }}" Genre
                </h5>
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add Book
                </a>
            </div>
            <div class="card-body">
                @if($genre->books->count() > 0)
                    <div class="row">
                        @foreach($genre->books as $book)
                            <div class="col-md-6 mb-3">
                                <div class="card border-left-success">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $book->title }}</h6>
                                        <p class="card-text small">
                                            <strong>Author:</strong> 
                                            <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                                                {{ $book->author->name }}
                                            </a>
                                        </p>
                                        <p class="card-text small">
                                            @if($book->genres->count() > 1)
                                                <strong>Other Genres:</strong>
                                                @foreach($book->genres as $otherGenre)
                                                    @if($otherGenre->id !== $genre->id)
                                                        <span class="badge bg-secondary">{{ $otherGenre->name }}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </p>
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <h6>No books found</h6>
                        <p class="text-muted">No books are categorized under this genre yet.</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Book
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('genres.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Genres
    </a>
</div>
@endsection 