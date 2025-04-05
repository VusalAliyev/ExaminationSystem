<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınav Grubu Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Sınav Grubu Düzenle</h1>
    <form action="{{ route('exam-groups.update', $examGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="GroupNumber" class="form-label">Grup Numarası</label>
            <input type="text" name="GroupNumber" id="GroupNumber" class="form-control" value="{{ $examGroup->GroupNumber }}" required>
            @error('GroupNumber')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
