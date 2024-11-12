<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Your Dashboard</h1>
        
        <!-- Search Bar -->
        <div class="mt-4">
            <form action="{{ route('searchTool') }}" method="POST" class="d-flex justify-content-center">
                @csrf
                <input type="text" name="tool_name" class="form-control w-50" placeholder="Search for a tool..." aria-label="Search">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>
        </div>
        
        <!-- Status Notifications -->
        <div class="mt-5">
            @if(session('status'))
                <div class="alert alert-info text-center">{{ session('status') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
        </div>
        
        <!-- Search Results -->
        @if(isset($tools) && $tools->isNotEmpty())
            <div class="row">
                @foreach ($tools as $tool)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tool->name }}</h5>
                            <p class="card-text">{{ Str::limit($tool->description, 50) }}</p>
                            <p class="card-text"><strong>Kategori:</strong> {{ ucfirst($tool->category) }}</p>

                            <!-- Bookmark Button -->
                            <form action="{{ route('addingBookmark') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="tool_id" value="{{ $tool->id }}">
                                <button type="submit" class="btn btn-warning">Bookmark</button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        
        <!-- Profile and Logout -->
        <div class="text-center mt-4">
            <a href="{{ route('profile') }}" class="btn btn-primary">Profile</a>
            
            <!-- Logout form -->
            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
