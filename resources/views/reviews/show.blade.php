@extends('layouts.app')

@section('title', 'Review - ' . $review->book->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-star"></i> Review for "{{ $review->book->title }}"
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Book Information</h6>
                                <p class="card-text">
                                    <strong>Title:</strong> 
                                    <a href="{{ route('books.show', $review->book) }}" class="text-decoration-none">
                                        {{ $review->book->title }}
                                    </a>
                                </p>
                                <p class="card-text">
                                    <strong>Author:</strong> 
                                    <a href="{{ route('authors.show', $review->book->author) }}" class="text-decoration-none">
                                        {{ $review->book->author->name }}
                                    </a>
                                </p>
                                @if($review->book->genres->count() > 0)
                                    <p class="card-text">
                                        <strong>Genres:</strong><br>
                                        @foreach($review->book->genres as $genre)
                                            <a href="{{ route('genres.show', $genre) }}" class="badge bg-secondary text-decoration-none me-1">
                                                {{ $genre->name }}
                                            </a>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h6>Rating</h6>
                            <div class="text-warning mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star fa-lg"></i>
                                    @else
                                        <i class="far fa-star fa-lg"></i>
                                    @endif
                                @endfor
                                <span class="ms-2 text-dark">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Review</h6>
                            <div class="border p-3 rounded bg-light">
                                {{ $review->content }}
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> Written on {{ $review->created_at->format('M d, Y \a\t H:i') }}
                                @if($review->updated_at != $review->created_at)
                                    <br><i class="fas fa-edit"></i> Last updated {{ $review->updated_at->format('M d, Y \a\t H:i') }}
                                @endif
                            </small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Review
                            </a>
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                    <i class="fas fa-trash"></i> Delete Review
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Reviews
        </a>
    </div>
</div>
@endsection 