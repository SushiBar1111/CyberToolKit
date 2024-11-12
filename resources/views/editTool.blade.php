<!-- resources/views/editTool.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboardView') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        </div>
        <h1 class="my-4">Edit Tool</h1>

        <form action="{{ route('updateTool', ['tool_id' => $tool->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tool_name">Nama Tool</label>
                <input type="text" name="tool_name" class="form-control" value="{{ $tool->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Tool</label>
                <textarea name="description" class="form-control" required>{{ $tool->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Kategori Tool</label>
                <select name="category" class="form-control" required>
                    <option value="red_team" {{ $tool->category == 'red_team' ? 'selected' : '' }}>Red Team</option>
                    <option value="blue_team" {{ $tool->category == 'blue_team' ? 'selected' : '' }}>Blue Team</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Tool</button>
        </form>

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
