<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Libretto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-book"></i> Libretto
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a class="nav-link" href="/register">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5">
                    <i class="fas fa-book fa-5x text-primary mb-4"></i>
                    <h1 class="display-4 mb-3">Welcome to Libretto</h1>
                    <p class="lead text-muted">Your personal library management system</p>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                                <h5>Manage Authors</h5>
                                <p class="text-muted">Keep track of your favorite authors and their works</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-book fa-3x text-success mb-3"></i>
                                <h5>Organize Books</h5>
                                <p class="text-muted">Catalog your book collection with genres and details</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-star fa-3x text-warning mb-3"></i>
                                <h5>Write Reviews</h5>
                                <p class="text-muted">Rate and review books with detailed feedback</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="mb-4">Get Started Today</h3>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i> Create Account
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-primary text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Libretto. Your personal library companion.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
