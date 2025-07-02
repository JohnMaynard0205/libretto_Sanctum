@extends('layouts.app')

@section('title', 'Genres - Libretto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-tags"></i> Genres</h1>
    <a href="{{ route('genres.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Genre
    </a>
    <a href="{{ route('dashboard') }}">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
</div>

<div class="card">
    <div class="card-body">
        @if($genres->count() > 0)
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
                        @foreach($genres as $genre)
                        <tr>
                            <td>{{ $genre->id }}</td>
                            <td>{{ $genre->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $genre->books_count }}</span>
                            </td>
                            <td>{{ $genre->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('genres.show', $genre) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('genres.edit', $genre) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this genre?')">
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
                {{ $genres->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5>No genres found</h5>
                <p class="text-muted">Start by adding your first genre.</p>
                <a href="{{ route('genres.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add First Genre
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 