<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberToolkit</title>
    {{-- Import CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
        <section class="explore-section">
            <h3>Discover the Ultimate Hacking Tools for Cybersecurity Enthusiast</h3>
            <a href="{{ url('/exploreTool') }}">
                <button class="explore-button" id="explore-button">Explore Tools</button>
            </a>
            <p>
                CyberToolKit is your go-to resource for discovering essential hacking tools designed 
                for cybersecurity professionals. We provide comprehensive descriptions of various tools, 
                helping users understand their features and use cases. While we don't offer direct access 
                to the tools, we aim to simplify your search by offering detailed information, enabling you 
                to make informed decisions about the best tools to suit your cybersecurity needs.
            </p>
        </section>
    </main>

    {{-- Import JS --}}
    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
