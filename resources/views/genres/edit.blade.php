@extends('layouts.app')

@section('title', 'Edit Genre - Libretto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit"></i> Edit Genre: {{ $genre->name }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('genres.update', $genre) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $genre->name) }}" 
                               required 
                               placeholder="Enter genre name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('genres.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Genres
                        </a>
                        <div>
                            <a href="{{ route('genres.show', $genre) }}" class="btn btn-info me-2">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Genre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 