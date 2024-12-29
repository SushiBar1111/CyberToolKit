<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tool->name }}</title>
    {{-- Import CSS --}}
    <link rel="stylesheet" href="{{ asset('css/Tool.css') }}">
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
            <div class="tool-detail">
                <a href="javascript:void(0);" class="back-arrow" onclick="goBack()">&#8592; Back</a>
                <img class="tool-logo" src="{{ asset('storage/' . $tool->photo) }}" alt="{{ $tool->name }} Logo">
                <p class="tool-name">{{ $tool->name }}</p>
                <p class="tool-description">{!! $tool->description !!}</p>
                
                @if($tool->example_image)
                    <p class="tool-description"><b>{{ $tool->name }} Usage Example</b></p>
                    <img class="tool-image-example" src="{{ asset('storage/' . $tool->example_image) }}" alt="{{ $tool->name }} Usage Example Image">
                @endif
            </div>
        </div>
    </main>

    {{-- Import JS --}}
    <script src="{{ asset('js/goback.js') }}"></script>
    <script src="{{ asset('js/searchicon.js') }}"></script>
    <script src="{{ asset('js/profileicon.js') }}"></script>
</body>
</html>
