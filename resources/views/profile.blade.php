<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <a href="{{ route('bookmarkPage') }}" class="btn btn-secondary mb-3">See your bookmark</a>
        </div>
        <h1 class="text-center">Profile Page</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Hello, {{ $user['username'] }}</h4>
                <p class="card-text"><strong>Email:</strong> {{ $user['email'] }}</p>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
