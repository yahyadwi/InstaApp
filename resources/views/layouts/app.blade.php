<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .navbar-brand { font-weight: bold; color: #E1306C !important; }
        .post-card { max-width: 600px; margin: 0 auto 20px; }
        .like-btn { cursor: pointer; font-size: 24px; }
        .liked { color: red; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">InstaApp</a>
            
            @auth
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/create">
                    <i class="bi bi-plus-square"></i>
                </a>
                <a class="nav-link" href="/profile/{{ Auth::user()->username }}">
                    <i class="bi bi-person-circle"></i>
                </a>
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
            @else
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/login">Login</a>
                <a class="nav-link" href="/register">Register</a>
            </div>
            @endauth
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>