<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Form</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-left">
            <a href="{{ route('dashboardView') }}"><h1>CyberToolKit</h1></a>
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
            <h3>Update Your Profile</h3>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('updateProfile') }}" method="POST" class="profile-update">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Enter your username" 
                        value="{{ old('username', auth()->user()->username) }}" 
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        value="{{ old('email', auth()->user()->email) }}" 
                        required>
                </div>
                <div class="form-group">
                    <label for="new-password">Change Password:</label>
                    <input 
                        type="password" 
                        id="new-password" 
                        name="new_password" 
                        placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password:</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        name="confirm_password" 
                        placeholder="Confirm your new password">
                </div>
                <button type="submit">Save</button>
            </form>
        </section>
    </main>
    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
