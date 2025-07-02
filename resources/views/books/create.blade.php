@extends('layouts.app')

@section('title', 'Add Book - Libretto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus"></i> Add New Book
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               required 
                               placeholder="Enter book title">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Author <span class="text-danger">*</span></label>
                        <select class="form-select @error('author_id') is-invalid @enderror" 
                                id="author_id" 
                                name="author_id" 
                                required>
                            <option value="">Select an author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" 
                                        {{ old('author_id', request('author_id')) == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <div class="row">
                            @foreach($genres as $genre)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               value="{{ $genre->id }}" 
                                               id="genre_{{ $genre->id }}"
                                               name="genres[]"
                                               {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="genre_{{ $genre->id }}">
                                            {{ $genre->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($genres->count() == 0)
                            <div class="text-muted small">
                                No genres available. <a href="{{ route('genres.create') }}">Create one first</a>.
                            </div>
                        @endif
                        @error('genres')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Books
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 