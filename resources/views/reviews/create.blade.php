@extends('layouts.app')

@section('title', 'Add Review - Libretto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus"></i> Add New Review
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="book_id" class="form-label">Book <span class="text-danger">*</span></label>
                        <select class="form-select @error('book_id') is-invalid @enderror" 
                                id="book_id" 
                                name="book_id" 
                                required>
                            <option value="">Select a book to review</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" 
                                        {{ old('book_id', request('book_id')) == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} by {{ $book->author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                        <div class="row">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="rating" 
                                               id="rating{{ $i }}" 
                                               value="{{ $i }}"
                                               {{ old('rating') == $i ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label" for="rating{{ $i }}">
                                            {{ $i }} 
                                            @for($j = 1; $j <= $i; $j++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                        </label>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        @error('rating')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Review Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" 
                                  name="content" 
                                  rows="5" 
                                  required 
                                  placeholder="Write your review here...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Reviews
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 