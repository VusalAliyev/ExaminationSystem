<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Sınav Grubu Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Yeni Sınav Grubu Ekle</h1>
    <form action="{{ route('exam-groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="GroupNumber" class="form-label">Grup Numarası</label>
            <input type="text" name="GroupNumber" id="GroupNumber" class="form-control" value="{{ old('GroupNumber') }}" required>
            @error('GroupNumber')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
