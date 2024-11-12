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
            <a href="{{ route('dashboardView') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        </div>
        <h1 class="my-4">Admin Dashboard</h1>
        <p>Halo Admin</p> <!-- Tulisan Halo Admin -->

        <!-- Tombol untuk menuju ke halaman daftar user -->
        <a href="{{ route('listUsers') }}" class="btn btn-info mb-3">Lihat Daftar User</a>

        <!-- Form untuk menambah tool -->
        <form action="{{ route('addTool') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tool_name">Nama Tool</label>
                <input type="text" name="tool_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Tool</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategori Tool</label>
                <select name="category" class="form-control" required>
                    <option value="red_team">Red Team</option>
                    <option value="blue_team">Blue Team</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Tool</button>
        </form>

        <hr>

        <!-- Daftar Tools -->
        <h3 class="my-4">Daftar Tools</h3>
        <div class="row">
            @foreach ($tools as $tool)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tool->name }}</h5>
                        <p class="card-text">{{ Str::limit($tool->description, 50) }}</p>
                        <p class="card-text"><strong>Kategori:</strong> {{ ucfirst($tool->category) }}</p> <!-- Menampilkan kategori -->
                        
                        <!-- Form untuk menghapus tool -->
                        <form action="{{ route('deleteTool') }}" method="POST" class="d-inline">
                            @csrf
                            <!-- Menyisipkan tool_id sebagai input hidden -->
                            <input type="hidden" name="tool_id" value="{{$tool->id}}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('editToolView', ['tool_id' => $tool->id]) }}" class="btn btn-warning">Edit</a>
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
