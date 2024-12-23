<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang ứng viên')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-candidate {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .auth-container {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
        }

        .auth-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: 2rem auto;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .btn-primary {
            width: 100%;
            padding: 0.8rem;
            font-size: 1.1rem;
            background-color: red;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-candidate">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Vieclamtainamchau</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-3 bg-light">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Vieclamtainamchau. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
