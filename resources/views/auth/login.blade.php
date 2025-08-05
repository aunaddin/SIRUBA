<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIRUBA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            padding-left: 40px;
        }

        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .btn-primary {
            background: #4facfe;
            border: none;
        }

        .btn-primary:hover {
            background: #3a8bd9;
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="text-center mb-4 fw-bold text-primary">SIRUBA</h3>
        <p class="text-center text-muted mb-4">Sistem Informasi Ruang BAPPEDA</p>

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3 position-relative">
                <span class="form-icon">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3 position-relative">
                <span class="form-icon">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
            <a href="{{ route('visitor.index') }}" class="btn btn-secondary w-100">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
