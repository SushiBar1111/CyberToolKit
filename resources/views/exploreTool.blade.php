<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools</title>
    {{-- Import CSS --}}
    <link rel="stylesheet" href="{{ asset('css/exploreTool.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/status.css') }}">
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
            <h2>Hacking Tools</h2>
            @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="tools-list">
                @forelse($tools as $tool)
                <a href="{{ route('tool', ['id' => $tool->id]) }}" class="tool-link">
                <div class="tool">
                    <form action="{{ route('addingBookmark') }}" method="POST" class="bookmark-form">
                        @csrf
                        <input type="hidden" name="tool_id" value="{{ $tool->id }}">
                        <button type="submit" class="bookmark-button" title="Add to bookmark">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </form>
                    <img class="tool-logo" src="{{ asset('storage/' . $tool->photo) }}" alt="{{ $tool->name }} Logo">
                    <p class="tool-name">{{ $tool->name }}</p>
                    <p class="tool-description">
                        {{ \Illuminate\Support\Str::limit($tool->description, 100) }}
                        @if(strlen($tool->description) > 100)
                            <span class="more-text" data-full-description="{{ $tool->description }}"> More...</span>
                        @endif
                    </p>
                    <p class="tool-description">{{ $tool->category }}</p>
                </div>
                </a>

                @empty
                    <p>No tools available at the moment.</p>
                @endforelse
            </div>
        </div>
    </main>

    {{-- Import JS --}}
    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
