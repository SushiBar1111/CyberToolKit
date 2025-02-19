<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Register</h3>

                <!-- Display session status -->
                @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <!-- Username field -->
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required autofocus>
                        <!-- Error message for username -->
                        @if ($errors->has('username') && old('username'))
                            <div class="text-danger">{{ $errors->first('username') }}</div>
                        @endif
                    </div>

                    <!-- Email field -->
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        <!-- Error message for email -->
                        @if ($errors->has('email') && old('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password field -->
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <!-- Error message for password -->
                        @if ($errors->has('password') && old('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <!-- Submit button -->
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </div>
                </form>
                <form action="{{ route('login') }}" method="GET">
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
