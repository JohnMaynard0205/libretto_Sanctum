@extends('layouts.app')

@section('title', $author->name . ' - Authors')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit"></i> Author Details
                </h5>
            </div>
            <div class="card-body">
                <h4>{{ $author->name }}</h4>
                <hr>
                <p><strong>ID:</strong> {{ $author->id }}</p>
                <p><strong>Books Count:</strong> {{ $author->books->count() }}</p>
                <p><strong>Created:</strong> {{ $author->created_at->format('M d, Y H:i') }}</p>
                <p><strong>Updated:</strong> {{ $author->updated_at->format('M d, Y H:i') }}</p>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this author?')">
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
                    <i class="fas fa-book"></i> Books by {{ $author->name }}
                </h5>
                <a href="{{ route('books.create') }}?author_id={{ $author->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add Book
                </a>
            </div>
            <div class="card-body">
                @if($author->books->count() > 0)
                    <div class="row">
                        @foreach($author->books as $book)
                            <div class="col-md-6 mb-3">
                                <div class="card border-left-primary">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $book->title }}</h6>
                                        <p class="card-text small">
                                            @if($book->genres->count() > 0)
                                                <strong>Genres:</strong>
                                                @foreach($book->genres as $genre)
                                                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                                                @endforeach
                                            @endif
                                        </p>
                                        <p class="card-text small">
                                            <strong>Reviews:</strong> {{ $book->reviews->count() }}
                                            @if($book->reviews->count() > 0)
                                                <span class="text-warning">
                                                    ({{ number_format($book->reviews->avg('rating'), 1) }} ★)
                                                </span>
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
                        <p class="text-muted">This author hasn't written any books yet.</p>
                        <a href="{{ route('books.create') }}?author_id={{ $author->id }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Book
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Authors
    </a>
</div>
@endsection 