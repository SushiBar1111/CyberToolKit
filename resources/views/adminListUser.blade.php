<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboardAdmin') }}" class="btn btn-secondary mb-3">Back to Admin Dashboard</a>
        </div>
        <h1 class="text-center">Manage Users</h1>

        <!-- Status Notifications -->
        @if(session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- User List -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- Form to Delete User -->
                                <form action="{{ route('deleteUser') }}" method="POST" class="d-inline">
                                    @csrf
                                    <!-- Menyisipkan user_id sebagai input hidden -->
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
