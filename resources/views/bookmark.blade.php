<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks - Tools</title>
    <link rel="stylesheet" href="{{ asset('css/bookmark.css') }}">
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
    <div class="main-container">
        <h2>Your Bookmarked Tools</h2>
        <div class="tools-list">
            @forelse ($bookmarkedTools as $bookmark)
                <div class="tool">
                    <div class="tool-header">
                        <form action="{{ route('deletingBookmark') }}" method="POST" class="delete-form">
                            @csrf
                            <input type="hidden" name="bookmark_id" value="{{ $bookmark->id }}">
                            <button type="submit" class="delete-button" title="Remove Bookmark">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <img class="tool-logo" src="{{ asset('storage/' . $bookmark->tool->photo) }}" alt="{{ $bookmark->tool->name }} Logo">
                    <p class="tool-name">{{ $bookmark->tool->name }}</p>
                    <p class="tool-description">{{ $bookmark->tool->description }}</p>
                </div>
                @empty
                    <p>You don't have any bookmarked tools yet.</p>
                @endforelse
            </div>
        </div>
    </main>

    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
