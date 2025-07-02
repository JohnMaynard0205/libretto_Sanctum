@extends('layouts.app')

@section('title', 'Authors - Libretto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-edit"></i> Authors</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Author
    </a>
    <a href="{{ route('dashboard') }}">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
</div>

<div class=

<div class="card">
    <div class="card-body">
        @if($authors->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Books Count</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $author->books->count() }}</span>
                            </td>
                            <td>{{ $author->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this author?')">
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
                {{ $authors->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-user-times fa-3x text-muted mb-3"></i>
                <h5>No authors found</h5>
                <p class="text-muted">Start by adding your first author.</p>
                <a href="{{ route('authors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add First Author
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 