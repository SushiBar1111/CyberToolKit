<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}"><h1>CyberToolKit</h1></a>
        </div>
        <div class="header-right">
            <div class="search-container">
                <div class="search-icon" id="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="search-bar" id="search-bar">
                    <form action="{{ route('searchTool') }}" method="POST">
                        @csrf
                        <input type="text" name="tool_name" placeholder="Enter tools" aria-label="Search">
                    </form>
                </div>
            </div>
            <div class="profile-icon-container">
                <div class="profile-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="profile-section">
            <h3>Login</h3>
            <form id="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                @if($errors->has('login'))
                    <span class="error-message" style="color: red; font-size: 0.9em;">{{ $errors->first('login') }}</span>
                @endif
                <a href="{{ url('/forgot-password') }}" id="lost-your-passwd"><i>Lost your password?</i></a>
                <div class="submit-button">
                    <button type="submit">Sign in</button>
                </div>
                <p>Don't have an account? <a href="{{ route('register') }}" id="back-to-register-form">Register</a></p>
            </form>
        </section>
    </main>
    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
