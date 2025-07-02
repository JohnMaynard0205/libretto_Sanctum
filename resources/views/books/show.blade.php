@extends('layouts.app')

@section('title', $book->title . ' - Books')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-book"></i> Book Details
                </h5>
            </div>
            <div class="card-body">
                <h4>{{ $book->title }}</h4>
                <hr>
                <p><strong>Author:</strong> 
                    <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                        {{ $book->author->name }}
                    </a>
                </p>
                <p><strong>Genres:</strong> 
                    @if($book->genres->count() > 0)
                        @foreach($book->genres as $genre)
                            <a href="{{ route('genres.show', $genre) }}" class="badge bg-secondary text-decoration-none me-1">
                                {{ $genre->name }}
                            </a>
                        @endforeach
                    @else
                        <span class="text-muted">None assigned</span>
                    @endif
                </p>
                <p><strong>Reviews:</strong> {{ $book->reviews->count() }}</p>
                @if($book->reviews->count() > 0)
                    <p><strong>Average Rating:</strong> 
                        <span class="text-warning">
                            {{ number_format($book->reviews->avg('rating'), 1) }} ★
                        </span>
                    </p>
                @endif
                <p><strong>Created:</strong> {{ $book->created_at->format('M d, Y H:i') }}</p>
                <p><strong>Updated:</strong> {{ $book->updated_at->format('M d, Y H:i') }}</p>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this book?')">
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
                    <i class="fas fa-star"></i> Reviews for "{{ $book->title }}"
                </h5>
                <a href="{{ route('reviews.create') }}?book_id={{ $book->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add Review
                </a>
            </div>
            <div class="card-body">
                @if($book->reviews->count() > 0)
                    @foreach($book->reviews as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="card-title mb-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2">{{ $review->rating }}/5</span>
                                        </h6>
                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('reviews.edit', $review) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text">{{ $review->content }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-star-half-alt fa-3x text-muted mb-3"></i>
                        <h6>No reviews yet</h6>
                        <p class="text-muted">Be the first to review this book!</p>
                        <a href="{{ route('reviews.create') }}?book_id={{ $book->id }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Review
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Books
    </a>
</div>
@endsection 