<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <title>GeoTest - Login</title>
</head>
<body>
    <div class="d-flex bg-dark bg-gradient align-items-center justify-content-center" style="height:100vh !important">
        <div class="card rounded-0" style="width:30rem">
            <div class="card-header">
                <h5 class="mb-0 fs-3">GeoTest</h5>
                <small class="lh-1 text-uppercase" style="font-size:.75rem">Test de programación</small>
            </div>
            <div class="card-body py-4">
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="email" class="form-control" id="fl-1" name="email" value="{{ old('email') }}" required>
                        <label for="fl-1">Email address:</label>
                    </div>
                    @error('email')
                    <div class="text-danger" style="font-size:.85rem">{{ $message }}</div>
                    @enderror

                    <div class="form-floating mt-3">
                        <input type="password" class="form-control" id="fl-2" name="password" required>
                        <label for="fl-2">Password:</label>
                    </div>
                    @error('password')
                    <div class="text-danger" style="font-size:.85rem">{{ $message }}</div>
                    @enderror

                    <hr>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success d-block">Login</button>
                    </div>
                </form>
                @if (session('login_failed'))
                <div class="alert alert-danger d-flex align-items-center mt-3 border border-danger">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    <div class="ms-2">
                        {{ session('login_failed') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
