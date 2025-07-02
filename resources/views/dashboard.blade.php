@extends('layouts.app')

@section('title', 'Dashboard - Libretto')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-primary">
            <div class="card-body text-center">
                <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Authors</h5>
                <p class="card-text">Manage book authors</p>
                <a href="{{ route('authors.index') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View Authors
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card border-success">
            <div class="card-body text-center">
                <i class="fas fa-book fa-3x text-success mb-3"></i>
                <h5 class="card-title">Books</h5>
                <p class="card-text">Manage your book collection</p>
                <a href="{{ route('books.index') }}" class="btn btn-success">
                    <i class="fas fa-eye"></i> View Books
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card border-warning">
            <div class="card-body text-center">
                <i class="fas fa-tags fa-3x text-warning mb-3"></i>
                <h5 class="card-title">Genres</h5>
                <p class="card-text">Organize by categories</p>
                <a href="{{ route('genres.index') }}" class="btn btn-warning">
                    <i class="fas fa-eye"></i> View Genres
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card border-info">
            <div class="card-body text-center">
                <i class="fas fa-star fa-3x text-info mb-3"></i>
                <h5 class="card-title">Reviews</h5>
                <p class="card-text">Book reviews and ratings</p>
                <a href="{{ route('reviews.index') }}" class="btn btn-info">
                    <i class="fas fa-eye"></i> View Reviews
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('authors.create') }}" class="btn btn-outline-primary btn-block w-100">
                            <i class="fas fa-plus"></i> Add Author
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('books.create') }}" class="btn btn-outline-success btn-block w-100">
                            <i class="fas fa-plus"></i> Add Book
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('genres.create') }}" class="btn btn-outline-warning btn-block w-100">
                            <i class="fas fa-plus"></i> Add Genre
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('reviews.create') }}" class="btn btn-outline-info btn-block w-100">
                            <i class="fas fa-plus"></i> Add Review
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 