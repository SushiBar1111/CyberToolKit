<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('profile') }}" class="btn btn-secondary mb-3">Back to Profile</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboardView') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        </div>
        <h1 class="my-4">Your Bookmarked Tools</h1>
        <!-- Daftar Tools -->
        <h3 class="my-4">Daftar Tools</h3>
        <div class="row">
            @foreach ($bookmarkedTools as $bookmark)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bookmark->tool->name }}</h5>
                        <p class="card-text">{{ Str::limit($bookmark->tool->description, 50) }}</p>
                        <p class="card-text"><strong>Kategori:</strong> {{ ucfirst($bookmark->tool->category) }}</p> <!-- Menampilkan kategori -->
                        
                        <!-- Form untuk menghapus tool -->
                        <form action="{{ route('deletingBookmark') }}" method="POST" class="d-inline">
                            @csrf
                            <!-- Menyisipkan tool_id sebagai input hidden -->
                            <input type="hidden" name="bookmark_id" value="{{$bookmark->id}}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Menampilkan pesan status jika ada -->
        @if(session('status'))
            <div class="alert alert-info mt-3">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
