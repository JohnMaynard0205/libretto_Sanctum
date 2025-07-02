@extends('layouts.app')

@section('title', 'Books - Libretto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book"></i> Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Book
    </a>
    <a href="{{ route('dashboard') }}">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
</div>

<div class="card">
    <div class="card-body">
        @if($books->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genres</th>
                            <th>Reviews</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>
                                <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                                    {{ $book->author->name }}
                                </a>
                            </td>
                            <td>
                                @foreach($book->genres as $genre)
                                    <span class="badge bg-secondary me-1">{{ $genre->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $book->reviews_count ?? 0 }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this book?')">
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
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                <h5>No books found</h5>
                <p class="text-muted">Start by adding your first book.</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add First Book
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 