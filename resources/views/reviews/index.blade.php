@extends('layouts.app')

@section('title', 'Reviews - Libretto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-star"></i> Reviews</h1>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Review
    </a>
    <a href="{{ route('dashboard') }}">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
</div>

<div class="card">
    <div class="card-body">
        @if($reviews->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book</th>
                            <th>Author</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>
                                <a href="{{ route('books.show', $review->book) }}" class="text-decoration-none">
                                    {{ Str::limit($review->book->title, 30) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('authors.show', $review->book->author) }}" class="text-decoration-none">
                                    {{ $review->book->author->name }}
                                </a>
                            </td>
                            <td>
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    ({{ $review->rating }})
                                </span>
                            </td>
                            <td>{{ Str::limit($review->content, 50) }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('reviews.show', $review) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this review?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-star-half-alt fa-3x text-muted mb-3"></i>
                <h5>No reviews found</h5>
                <p class="text-muted">Start by adding your first review.</p>
                <a href="{{ route('reviews.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add First Review
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 